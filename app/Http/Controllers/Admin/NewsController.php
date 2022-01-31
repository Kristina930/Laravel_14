<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Category;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        /*Почему-то талица categories_has_news в Воркбенч, когда я вношу данные вручную они не сохраняються там.
         При выводе категорий с БД показывает пусто. */

      //$news = News::whereHas('categories')->with('categories')->paginate(5);
        $news = News::with('categories')->paginate(5);

        return view('admin.news.index', [
            'newsList' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);

        $data = $request->only(['title', 'author', 'status', 'description']) +[
            'slug' => \Str::slug($request->input('title'))
            ];

        $created = News::create($data);
        if($created) {
            //foreach ($request->input('categories') as $category) {
               $created->categories()->attach($request->input('categories'));
            //}
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена');
        }
        return back()->with('error', 'Запись не добавилась')
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $selectCategories = \DB::table('categories_has_news')
        ->where('news_id', $news->id)
            ->get()
            ->map(fn($item) => $item->category_id)
            ->toArray();

        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories,
            'selectCategories' => $selectCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);

        $data = $request->only(['title', 'author', 'status', 'description']) + [
                'slug' => \Str::slug($request->input('title'))
            ];

       $updated = $news->fill($data)->save();

       if($updated) {

           \DB::table('categories_has_news')
               ->where('news_id', $news->id)
               ->delete();

           foreach ($request->input('categories') as $category) {
               \DB::table('categories_has_news')
                   ->insert([
                       'category_id' => intval($category),
                       'news_id' => $news->id
                   ]);
           }
           return redirect()->route('admin.news.index')
               ->with('success', 'Запись успешно добавлена');
       }
        return back()->with('error', 'Запись не обновилась')
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
