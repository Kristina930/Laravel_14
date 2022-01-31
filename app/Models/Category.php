<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cetegory extends Model
{
    use HasFactory;

    protected $table = "categories";

    public static $availableFields = ['id','title', 'author', 'status', 'description', 'created_at'];
}
