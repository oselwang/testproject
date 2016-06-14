<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = [ 'user_id', 'slug', 'description', 'name', 'portion', 'difficulty', 'duration', 'preparation', 'rating' ];

    protected $table = 'recipes';


    public static function boot()
    {

        parent::boot();

        static::created(function ($recipe) {
            $client = \Elasticsearch\ClientBuilder::create()
                ->setHosts([ 'http://localhost:9200' ])
                ->build();
            $recipes[0] = $recipe->toArray();
            $timestamp = array ( 'timestamp' => Carbon::now()->toDateTimeString() );
            $recipes[] = $timestamp;
            $params = [
                'index' => 'recipe',
                'type' => 'recipe',
                'id' => $recipe->id,
                'body' => $recipe->toArray()
            ];

            dd($client->index($params));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(RecipeCategory::class, 'pivotcategoryrecipe');
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function instruction()
    {
        return $this->hasMany(Instruction::class);
    }

    public function profilephoto()
    {
        return $this->hasOne(RecipeProfilePhoto::class);
    }

    public function coverphoto()
    {
        return $this->hasOne(RecipeCoverPhoto::class);
    }

    public function photo()
    {
        return $this->hasMany(RecipePhoto::class);
    }

    public function getProfilePhoto()
    {
        $profile_photo = $this->profilephoto()->first();

        return $profile_photo->photo_name;
    }

    public function getCategory()
    {
        $category = $this->categories()->get();

        return $category;
    }


    public function owner($recipe)
    {
        $user = $recipe->user()->first();

        return $user->present()->fullname;
    }

}
