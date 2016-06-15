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
    use App\PivotRecipeCategory;
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
            $pivot_recipe_category = new PivotRecipeCategory();


            if ($this->isValid()) {

                $slug = time() . '-' . str_replace(' ', '-', $this->fields('recipename'));

                $image_name = $this->addProfilePhoto($this->file('profilephoto'));

                $recipe_added = $recipe->create([
                    'user_id'     => Auth::user()->id,
                    'description' => $this->fields('description'),
                    'name'        => $this->fields('recipename'),
                    'portion'     => $this->fields('portion'),
                    'slug'        => $slug,
                    'difficulty'  => $this->fields('difficulty'),
                    'duration'    => $this->fields('duration'),
                    'preparation' => $this->fields('preparation'),
                    'photo_name'  => 'Recipe/RecipeProfilePhoto/' . $image_name
                ]);

                foreach (array_combine($this->fields('ingredient'), $this->fields('amount')) as $ingredient => $amount) {
                    $ingredients->create([
                        'recipe_id' => $recipe_added->id,
                        'name'      => $ingredient,
                        'amount'    => $amount
                    ]);
                }

                foreach ($this->fields('instruction') as $instruction) {
                    $instructions->create([
                        'recipe_id' => $recipe_added->id,
                        'body'      => $instruction
                    ]);
                }

                foreach ($this->fields('recipecategory') as $category) {
                    $pivot_recipe_category->create([
                        'recipe_id'          => $recipe_added->id,
                        'recipe_category_id' => $category
                    ]);
                }

                return $recipe_added;

            } else return false;

        }

        private function addProfilePhoto($profilephoto)
        {
            $originalname = rtrim($profilephoto->getClientOriginalName(), '.' . $profilephoto->getClientOriginalExtension());
            $extension = $this->file('profilephoto')->getClientOriginalExtension();
            $image_name = $originalname . '-' . time() . '-' . str_replace(' ', '-', $this->fields('recipename')). '.' . $extension;
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