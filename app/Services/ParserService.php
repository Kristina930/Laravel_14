<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Parser;
use Illuminate\Support\Facades\Storage;
use Laravie\Parser\Document;
use Orchestra\Parser\Xml\Facade as XmlParser;


class ParserService implements Parser
{
    /**
     * @var Document
     */

    private Document $document;
    private string $link;

    /**
     * @param string $link
     * @return Parser
     */
    public function setLink(string $link): Parser
    {
        $this->document = XmlParser::load($link);
        $this->link=$link;

        return $this;
    }

    /**
     * @return array
     */
    public function parse(): void
    {
        $data = $this->document->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,guid,description,pubDate]'
            ]
        ]);

        $encode = json_encode($data);

        $explode = explode("/", $this->link);
        $parseLink = end($explode);

        Storage::append('parsing/' . $parseLink, $encode);
    }
}
