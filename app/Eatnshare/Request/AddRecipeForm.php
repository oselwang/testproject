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
    use Intervention\Image\ImageManagerStatic as Image;

    class AddRecipeForm extends Form
    {

        protected $rules = [
            'portion'      => 'required',
            'recipename'   => 'required|min:5',
            'difficulty'   => 'required',
            'duration'     => 'required',
            'preparation'  => 'required',
            'ingredient'   => 'required',
            'instruction'  => 'required',
            'profilephoto' => 'required|mimes:jpeg,bmp,png'
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
                    'recipe_name' => $this->fields('recipename'),
                    'portion'     => $this->fields('portion'),
                    'difficulty'  => $this->fields('difficulty'),
                    'duration'    => $this->fields('duration'),
                    'preparation' => $this->fields('preparation'),
                ]);

                $image_name = $this->addProfilePhoto();

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

        private function addProfilePhoto()
        {
            $extension = $this->file('profilephoto')->getClientOriginalExtension();
            $image_name = time() . $this->fields('recipename') . '.' . $extension;
            $path = public_path('Recipe/RecipeProfilePhoto/' . $image_name);
            Image::make($this->file('profilephoto')->getRealPath())->resize(280, 200)->save($path);

            return $image_name;
        }

    }