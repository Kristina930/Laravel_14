<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order
{
    use HasFactory;

    protected $table = "order";

    public static $availableFields = ['id','user_id', 'news_id'];

    protected $fillable = [
        'user_id',
        'news_id',
    ];

}
