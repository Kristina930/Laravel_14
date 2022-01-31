<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('categories')->paginate(4);
        //$categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = News::all();
        return view('admin.categories.create', [
            'news' => $news,
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

        $data = $request->only(['title', 'description' ]) + [
                'slug' => \Str::slug($request->input('title'))
            ];

       // return response()->json($request->all(), 201);

      $created = Category::create($data);
        if($created) {
            //foreach ($request->input('categories') as $category) {
            $created->categories()->attach($request->input('news'));
            //}
            return redirect()->route('admin.categories.index')
                ->with('success', 'Запись успешно добавлена');
        }
        return back()->with('error', 'Запись не добавилась')
            ->withInput();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Отобразить категорию";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::all();
        $selectNews = \DB::table('categories_has_news')
            ->where('categories_id', $news->id)
            ->get()
            ->map(fn($item) => $item->categories_id)
            ->toArray();

        return view('admin.categories.edit', [
            'news' => $news,
            'categories' => $news,
            'selectNews' => $selectNews
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);

        $data = $request->only(['title', 'description']) + [
                'slug' => \Str::slug($request->input('title'))
            ];


        $updated = $categories->fill($data)->save();

        if($updated) {

            \DB::table('categories_has_news')
                ->where('categories_id', $categories->id)
                ->delete();

            foreach ($request->input('news') as $news) {
                \DB::table('categories_has_news')
                    ->insert([
                        'news_id' => intval($news),
                        'categories_id' => $categories->id
                    ]);
            }
            return redirect()->route('admin.categories.index')
                ->with('success', 'Запись успешно добавлена');
        }
        return back()->with('error', 'Запись не обновилась')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
