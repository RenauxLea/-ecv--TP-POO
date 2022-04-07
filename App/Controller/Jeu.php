<?php

declare(strict_types=1);

namespace App\Controller;
use App\Infra\Memory\PickWord;
use App\Elo\WordFactory;
use App\Elo\testInput;

class Jeu implements Controller
{
    private int $tentative = 0;
    private string $wordEnter = "";

    public function readResponse(){
        echo nl2br("\n Your word : ");
        $wordEnter = readline('Enter a word: ');
        echo $wordEnter; 
        $this->tentative++;
    }
    
    public function compareWord(string $wordToFind , string $wordEnter){
        $malPlace = array();

        for ($i = 0 ; $i < strlen($wordEnter); $i++){
            $check = false;
            if ( $wordEnter[$i] === $wordToFind[$i] ){
                
                echo " ",  $wordEnter[$i], " " ;
            }
            elseif($wordEnter[$i] !== $wordToFind[$i]){
                for( $j = 0 ; $j < strlen($wordToFind); $j++){
                    if($wordToFind[$j] === $wordEnter[$i]){
                        
                       
                        $color = "#FF9900";
                        echo "<span style=\"color: $color\"> $wordEnter[$j]</span> ";
                        
                        
                        $check = true;
                        break;
                    }
                }
            }
            if( $wordEnter[$i] !== $wordToFind[$i] && $check === false){
                
                echo  " _ ";
            }
        }
    }


    

    public function render()
    {
        echo nl2br("welcome on wordle ! \n  ");
       
        setcookie('tentative', "0");


        // if($_COOKIE('tentative') === 0){
            $wordToFind =  PickWord::findWord();  
            echo "word to find : " , $wordToFind , " <br /> it length : ", strlen($wordToFind) , " <br />";

        // }
        // elseif($_COOKIE('tentative') === )

        for ($i = 0 ; $i < strlen($wordToFind); $i++){
        
            echo " _ ";
        }

        echo "<br /> ";


        $this->compareWord("aimson", "maison");

    }
         
     
    //    $this->readResponse();


        

        // for ($tentative = 0; $tentative < 6; $tentative++ ){
        //     if($tentative == 0){
        //         $wordToFind =  PickWord::findWord();  
        //         echo "word to find : " , $wordToFind ;
        //     }
        //     if($tentative == 6){
        //         echo "perdu !";
        //     }

        //     $this->readResponse();
        // }
        // $word = WordFactory::createFromURL();
        // echo $word;
       
      
        
    
}

?>