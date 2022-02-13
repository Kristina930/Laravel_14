<?php

declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Orchestra\Parser\Xml\Facade as XmlParser;


class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function __invoke(Request $request, Parser $service)
    {
        $url = Arr::random(
            ['https://news.yandex.ru/music.rss', 'https://news.yandex.ru/games.rss']
        );
        dd(
            $service->setLink($url)
                ->parse()
        );
    }

}

