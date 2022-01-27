<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {

        dd(
           /* выводит пустой массив items
           \DB::table('news')
                ->join('categories_has_news as chn', 'news.id', '=', 'chn.news_id')
                ->join('categories', 'chn.category_id', '=', 'categories.id')
                ->select('news.*', 'categories.title as categoriesTitle')
                ->get()*/


        \DB::table('news')
            ->where('id', '>', 5)
            ->get()
        );


        $news = new News();
        $news = $this->getNews();
       //$news = [];

        return view('news.index', [
            'newsList' => $news
        ]);
    }

    public function show(int $id)
    {
        $news = new News();
        $news = $this->getNewsById($id);


        return view('news.show', [
            'news' => $news
        ]);
    }


}
