<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPUnit\Framework\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('categories')->paginate(5);
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
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validate() +[
                'slug' => Str::slug($request->input('title'))
            ];

        $created = Category::create($data);
        if($created) {
            $created->categories()->attach($request->input('categories'));

            return redirect()->route('admin.news.index')
                ->with('success', trans('messages.admin.categories.created.success'));
        }
        return back()->with('error', trans('messages.admin.categories.created.error'))
            ->withInput();
    }


    /**
     * Display the specified resource.
     *
     * @param  Category $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories)
    {
        return "Отобразить категорию";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories)
    {
        $news = News::all();
        return view('admin.categories.edit', [
            'categories' => $categories,
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Category $categories
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $categories)
    {
        $data = $request->validate() + [
                'slug' => Str::slug($request->input('title'))
            ];

        $updated = $categories->fill($data)->save();

        if($updated) {

            DB::table('categories_has_news')
                ->where('categories_id', $categories->id)
                ->delete();

            foreach ($request->input('news') as $news) {
                DB::table('categories_has_news')
                    ->insert([
                        'news_id' => intval($news),
                        'category_id' => $categories->id
                    ]);
            }
            return redirect()->route('admin.categories.index')
                ->with('success', trans('messages.admin.categories.update.success'));
        }
        return back()->with('error', trans('messages.admin.categories.update.error'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $categories
     * @param $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $categories)
    {
        try{
            $categories->delete();
            return response()->json('ok');
        }catch (\Exception $e) {
            Log::error('News error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
