<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getNews(?int $id = null): array
    {
        $faker = Factory::create();
        $news = [];

        if ($id) {
            return [
                'id' => $id,
                'title' => $faker->jobTitle(),
                'description' => $faker->text(100),
                'author' => $faker->userName(),
                'created_at' => now('Europe/Moscow')
            ];
        }

        for ($i = 1; $i < 5; $i++) {
            $news[] = [
                'id' => $i,
                'category' => floor($i * 1), //каждые 5 новостей по 4 категории
                'title' => $faker->jobTitle(),
                'description' => $faker->text(100),
                'author' => $faker->userName(),
                'created_at' => now('Europe/Moscow')
            ];
        }
        return $news;
    }

}
