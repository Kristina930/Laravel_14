<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order
{
    use HasFactory;

    protected $table = "order";

    public static $availableFields = ['id','user_id', 'user_id'];

    protected $fillable = [
        'user_id',
        'user_id',
    ];

}
