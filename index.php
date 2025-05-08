<?php

spl_autoload_register (function ($className) {

    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filename = str_replace('App/', __DIR__ . '/app/', $className) . '.php';

    if (file_exists($filename)){
        require $filename;
    }
});
session_start();
use App\Animal\Animal;
use App\Game;
 
//Je récupère Game en session
$game = $_SESSION['game'] ?? Game::getInstance();

if (isset($_POST['step'])){
    //Si j'ai une step à traiter

     //je traite l'action

     switch ($_POST['step']){

    case'createAnimal':
    $animal = new Animal($_POST['icon'], $_POST['name']);
    $game->addAnimal($animal);

    break;

    case 'reset':
        $game=null;

        break;

    case 'night':
        $game->night();
        
        break;
        
        case 'searchProvisions':
            $game->searchProvisions();
            break;
        
        case 'feed':
                $animalIndex = $_POST['animal'] ?? null;
                $provisionIndex = $_POST['provision'] ?? null;
            
                if (isset($animalIndex, $provisionIndex)) {
                    $animal = $game->getAnimals()[$animalIndex];
                    $provision = $game->getProvision()[$provisionIndex];
                    $animal->consume($provision);
                    $game->useProvision($provisionIndex);
                    $game->addMessage("Vous avez nourri {$animal->getName()} !");
                }
        break;
            
        case 'heal':
            $index = (int)$_POST['animal'];
            if (isset($game->getAnimals()[$index])) {
                $game->getAnimals()[$index]->heal();
                $game->consumePoints(3);
            }   
            break;
        
            case 'caress':
                $index = (int)$_POST['animal'];
                if (isset($game->getAnimals()[$index])) {
                    $animal = $game->getAnimals()[$index];
                    $points = rand(0, 30);
            
                    $animal->changeMood($points);
                    $game->addMessage("{$animal->getName()} a reçu {$points} points d'humeur en caresses !");
                    $game->consumePoints(2);
                }
                break;                 
     }
      
       //Je termine par une redirection
        header('Location: index.php');
      
    }else{
        //Sinon j'affiche l'interface du jeu
        require('interphase.php');

        $game->clearMessages();
  
}

//Sauvegarde game en session
$_SESSION['game']= $game;

