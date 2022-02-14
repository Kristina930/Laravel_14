<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory, Sluggable;

    protected $table = "news";

    public static $availableFields = ['id','title', 'author', 'status', 'image', 'description', 'created_at'];

    protected $fillable = [
        'title',
        'slug',
        'author',
        'status',
        'description',
        'image'
    ];

   public  function categories(): BelongsToMany
   {
       return $this->belongsToMany(Category::class, 'categories_has_news','news_id', 'category_id');
   }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
