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
        $wordEnter = $_GET['wordEnter'] ;
        return $wordEnter;
       
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
                        echo "<span style=\"color: $color\"> $wordEnter[$i]</span> ";
                        
                        
                        $check = true;
                        break;
                    }
                }
            }
            if( $wordEnter[$i] !== $wordToFind[$i] && $check === false){
                
                echo  " _ ";
            }
        }

        echo " <br /> ";
    }

    

    public function render(){

        echo nl2br("welcome on wordle ! <br /> Si la lettre est en jaune alors mal placé, si noir bien placé \n  ");
       
        setcookie('tentative', '0');

        if( $_COOKIE['tentative'] === '0'){
            $wordToFind =  PickWord::findWord(); 
            echo "word to find : " , $wordToFind , " <br /> ";
            setcookie('wordTofind', $wordToFind);
            $tentative = intval($_COOKIE['tentative']) +1 ;
            setcookie('tentative', strval($tentative));
            setcookie('wordsTry', '');
           
        }

        if($_COOKIE['tentative'] < '5'   ){
            $tentative = intval($_COOKIE['tentative']) +1 ;
            setcookie('tentative', strval($tentative));
            $wordToFind = $_COOKIE['wordTofind'];
            $tentativeRestante = 6 - $tentative;
            echo " <br /> nombre de tentative restante ", $tentativeRestante;
        }

        elseif ($_COOKIE['tentative'] <= '5' ){
        setcookie('tentative', '0');
        echo "vous avez perdu !";
        }

        

        

        echo "<br /> ";
        
        $responseUser = $this->readResponse();
        
        $this->compareWord($wordToFind, $responseUser);

      
        
        

      


    }
         


        

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