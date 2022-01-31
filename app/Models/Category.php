<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    public static $availableFields = ['id','title', 'description', 'created_at'];

    protected $fillable = [
        'title',
        'description',
        'created_at'
    ];

    public  function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_has_news');
    }
}
