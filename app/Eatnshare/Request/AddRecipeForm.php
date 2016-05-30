<?php
    /**
     * Created by PhpStorm.
     * User: bahasolaptop2
     * Date: 03/05/16
     * Time: 13:18
     */

    namespace App\Eatnshare\Request;


    use App\Ingredient;
    use App\Instruction;
    use App\Recipe;
    use App\RecipeProfilePhoto;
    use Auth;
    use Intervention\Image\Exception\NotWritableException;
    use Intervention\Image\ImageManagerStatic as Image;

    class AddRecipeForm extends Form
    {

        protected $rules = [
            'portion'        => 'required',
            'description'    => 'required',
            'recipename'     => 'required|min:5',
            'difficulty'     => 'required',
            'duration'       => 'required',
            'preparation'    => 'required',
            'ingredient'     => 'required',
            'instruction'    => 'required',
            'profilephoto'   => 'required|mimes:jpeg,bmp,png',
            'recipecategory' => 'required'
        ];

        public function create()
        {
            $recipe = new Recipe();
            $ingredients = new Ingredient();
            $instructions = new Instruction();
            $profile_photo = new RecipeProfilePhoto();

            if ($this->isValid()) {

                $recipe_added = $recipe->create([
                    'user_id'     => Auth::user()->id,
                    'description' => $this->fields('description'),
                    'name'        => $this->fields('recipename'),
                    'portion'     => $this->fields('portion'),
                    'difficulty'  => $this->fields('difficulty'),
                    'duration'    => $this->fields('duration'),
                    'preparation' => $this->fields('preparation'),
                ]);

                $image_name = $this->addProfilePhoto($this->file('profilephoto'));

                $profile_photo->create([
                    'recipe_id'  => $recipe_added->id,
                    'photo_name' => 'Recipe/RecipeProfilePhoto/' . $image_name
                ]);

                foreach ($this->fields('ingredient') as $ingredient) {
                    foreach ($this->fields('amount') as $amount) {
                        $ingredients->create([
                            'recipe_id'       => $recipe_added->id,
                            'ingredient_name' => $ingredient,
                            'amount'          => $amount
                        ]);
                    }
                }

                foreach ($this->fields('instruction') as $instruction) {
                    $instructions->create([
                        'recipe_id'   => $recipe_added->id,
                        'instruction' => $instruction
                    ]);
                }

                return $recipe_added;

            } else return false;

        }

        private function addProfilePhoto($profilephoto)
        {
            $originalname = rtrim($profilephoto->getClientOriginalName(), '.' . $profilephoto->getClientOriginalExtension());
            $extension = $this->file('profilephoto')->getClientOriginalExtension();
            $image_name = $originalname . '-' . time() . '-' . $this->fields('recipename') . '.' . $extension;
            $path = public_path('Recipe/RecipeProfilePhoto/' . $image_name);

            try {
                Image::make($this->file('profilephoto')->getRealPath())->resize(400, 250)->save($path);
            } catch (NotWritableException $e) {
                $directory = rtrim($path, $image_name);
                \File::makeDirectory($directory, $mode = 0777, true, true);
            } finally {
                Image::make($this->file('profilephoto')->getRealPath())->resize(400, 250)->save($path);
            }

            return $image_name;

        }
    }