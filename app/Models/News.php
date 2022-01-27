<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    protected  $availableFields = ['id','title', 'author', 'status', 'description', 'created_at'];


    public function getNews(): array
    {
        return \DB::table($this->table)->select(['id','title', 'author', 'status', 'description', 'created_at'])
            ->select($this->availableFields)
            ->get()
            ->toArray();

    }

    public function getNewsById($id)
    {
        return \DB::table($this->table)->find($id, $this->availableFields);
    }

}
