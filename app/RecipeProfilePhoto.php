<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class RecipeProfilePhoto extends Model
    {
        protected $fillable = ['recipe_id', 'photo_name'];

        protected $table = 'recipeprofilephotos';

        public static function boot()
        {
            parent::boot();

            static::created(function($profilephoto){
                $client = \Elasticsearch\ClientBuilder::create()
                    ->setHosts(['http://localhost:9200'])
                    ->build();

                $params = [
                    'index' => 'recipe',
                    'type'  => 'recipe',
                    'id'    => $profilephoto->recipe_id,
                    'body'  => [
                        
                        'photo_name' => $profilephoto->photo_name
                    ]
                ];
                $client->index($params);
            });

        }

        public function recipe()
        {
            return $this->belongsTo(Recipe::class);
        }
    }
