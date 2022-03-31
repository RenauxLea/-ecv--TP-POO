<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Word;

class PickWord 
{
    private const FILE_PATH = __DIR__ . '/../../../var/word.json';
    private static array $words = [];
   
   

    private static function loadFile()
    {
        if (empty(self::$words)) {
            self::$words = json_decode(file_get_contents(self::FILE_PATH), true);
        }
        

        return self::$words;
    }

    

    public static function findWord()
    {
         self::loadFile();
       

        if (count(self::$words) > 1) {
           $randomKey = array_rand(self::$words, 1);
           
           return self::$words[$randomKey] ;
           
        }

        if (count(self::$words) === 0) {
            throw new \RuntimeException("No word found ");
        }

    }
}