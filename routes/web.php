<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\UserController as AdminUserController;
use App\Http\Controllers\OrderController as AdminOrderController;

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

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function ()
{
    Route::view('/', 'admin.index')->name('index');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
    Route::resource('/order', AdminOrderController::class);
    Route::resource('/user', AdminUserController::class);
});


Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

/*После того как мы изменили newsList на '/news/{news}' главная страница выдает ошибку
Missing required parameter for [Route: news.show] [URI: news/{news}] [Missing parameter: news]. (View: /var/www/html/resources/views/news/index.blade.php)
*/
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');
Route::get('/categories/{categories}', [CategoryController::class, 'show'])
    ->where('categories', '\d+')
    ->name('categories.show');


Route::get('sql', function ()
{
    dump(
        \DB::table('news')
            //->where('id', '>', 5)
            ->where([
                ['title', 'like', '%'. request()->get('q'). '%'],
                ['id', '<', 10]
            ])
            ->orWhere('author', '=', 'Admin')
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
    dd($collection->map(function ($item) {
        return $item * 2;
    })->sort(function ($sort) {
        return $sort % 3;
    })->all()
    );
});



