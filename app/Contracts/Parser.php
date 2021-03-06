<?php

declare(strict_types=1);

namespace App\Contracts;

interface Parser
{
    /**
     * @param string $link
     * @return $this
     */

    //Метод устанавливает ссылку и возвращает объект текущего класса
    public function setLink(string $link): self;

    /**
     * @return array
     */
    public function parse(): void;
}
