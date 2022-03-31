<?php

declare(strict_types=1);

namespace App\Elo;

class WordFactory
{
    public static function createFromURL(): Word
    {
        $word = $_GET['word'] ?? null;
       

        return new Word($word);
    }
}