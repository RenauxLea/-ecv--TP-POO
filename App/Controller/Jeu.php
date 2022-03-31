<?php

declare(strict_types=1);

namespace App\Controller;

class Jeu implements Controller
{
    public function render()
    {
       echo nl2br("welcome on wordle ! \n Your word : ");
       $wordEnter = readline('Enter a word: ');
       echo $wordEnter;   
    }
}