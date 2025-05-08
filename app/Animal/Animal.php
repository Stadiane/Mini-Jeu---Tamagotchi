<?php
namespace App\Animal;

use App\Provision\Provision;
use App\Game;

class Animal
{
    private $icon;
    private $name;
    private $age = 0;

    private $health = 100;
    private $mood = 100;
    private $hunger = 50;
    private $thirst = 50;

    public function __construct($icon, $name) {
        $this->icon = $icon;
        $this->name = $name;
    }

    public function consume(Provision $provision)
    {
        $this->changeHealth($provision->getHealthPoints());
        $this->changeMood($provision->getMoodPoints());
        $this->changeHunger($provision->getHungerPoints());
        $this->changeThirst($provision->getThirstPoints());
    }

    public function isDead()
    {
        return $this->health == 0;
    }

    public function getIcon(){
        return $this->icon;
    }

    public function getName(){
        return $this->name;
    }

    public function getAge(){
        return $this->age;
    }

    public function getHealth(){
        return $this->health;
    }

    public function getMood(){
        return $this->mood;
    }

    public function getHunger(){
        return $this->hunger;
    }

    public function getThirst(){
        return $this->thirst;
    }

    public function caress() {
        $points = rand(0, 30);
        $this->changeMood($points);
    }

    public function heal() {
        $points = rand(20, 100); 
        $this->changeHealth($points);
    
        $game = Game::getInstance();
        $game->addMessage("{$this->name} a été soigné de +{$points} points de santé !");
    }

    public function changeHealth($points)
    {
        $this->health += $points;
        $this->health = max(0, min(100, $this->health));
    }

    public function changeMood($points)
    {
        $game = Game::getInstance();
        $this->mood = max(0, min(100, $this->mood + $points));
    }

    public function changeHunger($points)
    {
        $game = Game::getInstance();
        $game->addMessage("{$this->name} : {$points} de faim");

        $this->hunger = max(0, min(100, $this->hunger + $points));
    }

    public function changeThirst($points)
    {
        $this->thirst += $points;
        $this->thirst = max(0, min(100, $this->thirst + $points));
    }

    public function sleep()
    {
        if (! $this->isDead()){
            $this->age++;
            $this->changeHunger(rand(5, 15));
            $this->changeThirst(rand(5, 15));
            $this->changeMood(rand(-80, 80));

            if($this->hunger >= 100){
                $this->changeHunger(rand(-30, -10));
            }

            if($this->thirst >= 100){
                $this->changeThirst(rand(-30, -10));
            }

            if($this->mood <= 0){
                $this->changeMood(rand(-20, 0));
            }
        }
    }

    // Nouvelle méthode pour ajuster l'état en fonction de la saison
    public function adjustForSeason($season) {
        switch ($season) {
            case 'printemps':
                $this->changeHunger(-5);  
                $this->changeThirst(5);    
                break;

            case 'été':
                $this->changeHunger(-10);  
                $this->changeThirst(20);   
                break;

            case 'automne':
                $this->changeHunger(10);   
                $this->changeThirst(-5);   
                break;

            case 'hiver':
                $this->changeHunger(20);   
                $this->changeThirst(10);  
                break;
        }

        // Limiter les valeurs entre 0 et 100 après ajustement
        $this->hunger = max(0, min(100, $this->hunger));
        $this->thirst = max(0, min(100, $this->thirst));
        $this->health = max(0, min(100, $this->health));
        $this->mood = max(0, min(100, $this->mood));
    }
}
?>
