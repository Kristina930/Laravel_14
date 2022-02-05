<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
    }


    //Показывает 27 ошибку в данном тесте, а именно вся функция неработает
      public function testShow()
    {
        $news = News::factory()->create();
        $response = $this->get(route('news.show', ['news' => $news]));

        $response->assertStatus(200);
    }
}
