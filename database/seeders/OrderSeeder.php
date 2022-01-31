<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('order')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        $faker = Factory::create();

        for($i=0; $i<10; $i++) {
            $data[] =[
                'user_id' => $faker->sentence(10),
                'news_id' => $faker->text(100)
            ];
        }

        return $data;
    }
}
