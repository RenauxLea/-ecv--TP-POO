<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infra\Memory\PickWord;

class Jeu implements Controller
{
    public function readResponse()
    {
        $wordEnter = $_GET['wordEnter'];

        return $wordEnter;
    }

    public function compareWord(string $wordToFind, string $wordEnter): void
    {
        // ce n'est pas une bonne idée, une méthode répétée à chaque tour de boucle pour un truc qui ne change pas
        for ($i = 0; $i < \strlen($wordEnter); ++$i) {
            $check = false;
            if ($wordEnter[$i] === $wordToFind[$i]) {
                echo ' ',  $wordEnter[$i], ' ';
            } elseif ($wordEnter[$i] !== $wordToFind[$i]) {
                for ($j = 0; $j < \strlen($wordToFind); ++$j) {
                    if ($wordToFind[$j] === $wordEnter[$i]) {
                        $color = '#FF9900';
                        echo "<span style=\"color: $color\"> $wordEnter[$i]</span> ";

                        $check = true;
                        break;
                    }
                }
            }
            if ($wordEnter[$i] !== $wordToFind[$i] && false === $check) {
                echo ' _ ';
            }
        }

        echo ' <br /> ';
    }

    // dommage le mélange logique / affichage
    public function render(): void
    {
        echo nl2br('welcome on wordle ! <br /> Si la lettre est en jaune alors mal placé, si noir bien placé ');

        echo " <br /> rafraichissez la page pour avancer dans le jeu <br />
        jouer avec l'url : /jeu?wordEnter=leMot
        <br /><br />";

        setcookie('tentative', '0'); // ceci n'écrit pas dans $_COOKIE et reset a chaque chargement de page

        // au premier lancement, $_COOKIE['tentative'] === '0' n'existe pas et provoque une erreur
        if ('0' === $_COOKIE['tentative'] ?? '0') {
            $wordToFind = PickWord::findWord();
            setcookie('wordTofind', $wordToFind);

            echo '';
            $tentative = (int) ($_COOKIE['tentative']) + 1;
            setcookie('tentative', (string) $tentative);

            for ($i = 0; $i < \strlen($wordToFind); ++$i) {
                echo ' _ ';
            }
        } elseif (($_COOKIE['tentative'] ?? '0') < '5') {
            $tentative = (int) ($_COOKIE['tentative']) + 1;
            setcookie('tentative', (string) $tentative);
            $wordToFind = $_COOKIE['wordTofind'];
            $tentativeRestante = 6 - $tentative;
            $responseUser = $this->readResponse(); // pourquoi, plutôt que récupérer directement de $_GET ?
            $this->compareWord($wordToFind, $responseUser);
            echo ' <br /> nombre de tentative restante ', $tentativeRestante;
            if ($responseUser === $wordToFind) {
                echo '<br /> <br /> Vous avez gagné !!!';
                setcookie('tentative', '0');
            }
        } elseif (($_COOKIE['tentative'] ?? '0') > '5') {
            $wordToFind = $_COOKIE['wordTofind'];
            echo 'vous avez perdu ! Le mot à trouver était ', $wordToFind;
            setcookie('tentative', '0');
        }

        echo '<br /> ';
    }
}
