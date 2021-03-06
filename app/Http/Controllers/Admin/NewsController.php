<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        return view('admin.news.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *

     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $created = News::create($request->validate());
        if($created) {
               $created->categories()->attach($request->input('categories'));

            return redirect()->route('admin.news.index')
                ->with('success', trans('messages.admin.news.created.success'));
        }
            return back()->with('error', trans('messages.admin.news.created.error'))
                 ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  News $news
     * @return Response
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
        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, News $news)
    {
        $validate = $request->validate();
        if($request->hasFile('image')) {

            $validate['image'] = app(UploadService::class)->saveFile(
                $request->file('image')
            );
        }

       $updated = $news->fill($validate)->save();
       if($updated) {
           $news->categories()->detach();
           $news->categories()->attach($request->input('categories'));

           return redirect()->route('admin.news.index')
               ->with('success', trans('messages.admin.news.update.success'));
       }
        return back()->with('error', trans('messages.admin.news.update.error'))
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @param $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(News $news)
    {
        try{
            $news->delete();
            return response()->json('ok');
        }catch (\Exception $e) {
            Log::error('News error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
