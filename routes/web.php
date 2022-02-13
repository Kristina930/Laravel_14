<?php

use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use \App\Http\Controllers\Account\IndexController as AccountController;
use \App\Http\Controllers\Auth\ProfileController as ProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//news

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/account', AccountController::class)
        ->name('account');

    Route::get('/logout', function()
    {
        Auth::logout();
        return redirect()->route('login');
    })->name('account.logout');

    Route::match(['post', 'get'], '/update', ProfileController::class)
        ->name('account.profile.update');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function()
    {
        Route::get('/parser', ParserController::class)
            ->name('parser');
        Route::view('/', 'admin.index')->name('index');
        Route::resource('/categories', AdminCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
    });
});


Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');


Route::get('sql', function ()
{
    dd(
        \App\Models\News::find(2)->categories()->where('id', '>', 10)->toSql()
    );
    dump(
        DB::table('news')
            //->where('id', '>', 5)
            ->whereNotBetween('id', [7,9])
            ->orderBy('id', 'desc')
            ->get()
    );
});

Route::get('/collection', function ()
{
    $arr = [
        1,5,3,4,6,19,10
    ];
    $arr2 = [
       'names' => [
           'Ann', 'Kris', 'Bill', 'Mike', 'Joly'
       ],

        'ages' => [
            20, 35, 15, 31, 26
        ]
    ];

    $collection = collect($arr);
    $collection2 = collect($arr2);

    //dd($collection->count());
    dd(
        $collection->where('ages', '>', 20)
    );
});

Route::get('/session', function() {
    if(session()->has('test')) {
        //dd(session()->all(), session()->get('test'));
        //удаление
        session()->forget('test');
    }

    session(['test' => rand(1,1000)]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'guest'], function() {
    Route::get('auth/{network}/redirect', [SocialController::class, 'redirect'])
        ->where('network', '\w+')
        ->name('auth.redirect');
    Route::get('auth/{network}/callback', [SocialController::class, 'callback'])
        ->where('network', '\w+')
        ->name('auth.callback');
});
