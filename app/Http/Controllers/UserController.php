<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('users')->paginate(4);

        return view('admin.user.index', [
            'users' => $user
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
        return view('admin.user.create', [
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
            'title' => ['required', 'min:5']
        ]);

        $data = $request->only(['id','name', 'email', 'password', 'phone_numbers', 'comments' ]) + [
                'slug' => Str::slug($request->input('title'))
            ];

        $created = User::create($data);
        if($created) {
            $created->categories()->attach($request->input('users'));

            return redirect()->route('admin.user.index')
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
        //
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
        $selectNews = DB::table('order')
            ->where('user_id', $news->id)
            ->get()
            ->map(fn($item) => $item->user_id)
            ->toArray();

        return view('admin.user.edit', [
            'news' => $news,
            'users' => $user,
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
        $data = $request->only(['id','name', 'email', 'password', 'phone_numbers', 'comments']) + [
                'slug' => Str::slug($request->input('title'))
            ];

        $updated = $user->fill($data)->save();

        if($updated) {

            DB::table('order')
                ->where('user_id', $user->id)
                ->delete();

            foreach ($request->input('news') as $news) {
                DB::table('order')
                    ->insert([
                        'user_id' => intval($user->id),
                        'news_id' => $news->id
                    ]);
            }
            return redirect()->route('admin.user.index')
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
