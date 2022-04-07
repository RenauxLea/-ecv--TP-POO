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

    // public function compareWord(string $wordToFind , string $wordEnter){	    

    //     for($j = 0 ; $j< strlen($wordEnter); $j++){
    //             for($i=0;$i<=25;$i++){

    //                 if($wordEnter[$j] === chr(97+$i) && $wordToFind[$j] !== chr(97+$i ) && str_contains($wordToFind, chr(97+$i )) ) {
    //                     echo "<br />",chr(97+$i) ," lettre pas bien placé  ";
    //                 }

    //                 if($wordEnter[$j] === chr(97+$i) && $wordToFind[$j] === chr(97+$i)) {
    //                     echo "<br /> lettre bien placé  ";
    //                 }       
    //         }
    //     }
    // }    
    
    public function compareWord(string $wordToFind , string $wordEnter){
       
        for ($i = 0 ; $i < strlen($wordEnter); $i++){
             $check = false;
               if ( $wordEnter[$i] === $wordToFind[$i] ){
                
                echo  $wordEnter[$i] , " bien placé   -   ";
              }
            elseif($wordEnter[$i] !== $wordToFind[$i]){
                for( $j = 0 ; $j < strlen($wordToFind); $j++){
                    if($wordToFind[$j] === $wordEnter[$i]){
                        
                        echo  $wordEnter[$i] , " mal placé    -    ";
                        $check = true;
                        break;
                    }
                }
            }
            if( $wordEnter[$i] !== $wordToFind[$i] && $check === false){
                
                echo   $wordEnter[$i] , " pas là    -    ";
            }
        }

        


    }


    

    public function render()
    {
        echo nl2br("welcome on wordle ! \n  ");
       

        if($this->tentative === 0){
            $wordToFind =  PickWord::findWord();  
            echo "word to find : " , $wordToFind , " <br /> it length : ", strlen($wordToFind) , " <br />";

        }

        $this->compareWord("peluche", "peliche");

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