<?php

namespace App;
use App\Animal\Animal;
use App\Provision\Watermelon;
use App\Provision\Burger;
use App\Provision\Cola;
use App\Provision\Water;

class Game {
    private $points = 3;
    private $days = 1;
    private $season; // Saison actuelle

    private $animals = [];
    private $provisions = [];

    private $messages = [];

    private static $instance = null;

    private function __construct()
    {
        $this->changerSaison(); // Définir la saison au départ
    }

    public function __wakeup()
    {
        self::$instance = $this;
    }

    public function getDays(){
        return $this->days;
    }

    public function getPoints(){
        return $this->points;
    }

    public function getMessages() {
        return $this->messages;
    }

    public function addMessage($message){
        $this->messages[] = $message;
    }

    public function clearMessages(){
        $this->messages = [];
    }

    public static function getInstance()
    {
        if (self::$instance === null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getAnimals(){
        return $this->animals;
    }

    public function addAnimal(Animal $animal)
    {
        if($this->consumePoints(1)){
            $this->animals[] = $animal;
            $this->addMessage("Bienvenue {$animal->getName()} !"); 
        }
    }

    public function night(){
        $this->days++;
        $this->points += 3;

        $this->addMessage('La nuit est passée');

        
        foreach($this->animals as $animal) {
            $animal->adjustForSeason($this->season); 
            $animal->sleep(); 
        }

        // Changer de saison 
        if ($this->days % 5 == 0) {
            $this->changerSaison();
        }
    }

    public function consumePoints($points)
    {
        if ($this->points >= $points){
            $this->points -= $points;
            return true;
        }

        $this->addMessage("Vous n'avez pas assez de points pour effectuer cette action.");
        return false;
    }

    public function getProvision(){
        return $this->provisions;
    }

    public function useProvision($index) {
        unset($this->provisions[$index]);
        $this->provisions = array_values($this->provisions);
    }

    public function searchProvisions()
    {
        if ($this->consumePoints(1)){
            $random = rand(1, 100);

            if ($random <= 30) {
                $this->addProvision(new Watermelon);
            } elseif ($random <= 50) {
                $this->addProvision(new Burger);
            } elseif ($random <= 80) {
                $this->addProvision(new Cola);
            } elseif ($random <= 90) {
                $this->addProvision(new Water);
            } else {
                $this->addMessage("Aucune provision trouvée...");
            }
        }
    }

    public function addProvision($provision)
    {
        $this->provisions[] = $provision;
        $this->addMessage("Vous avez trouvé : " . $provision->getName());
    }

    // Méthode pour gérer le changement de saison
    private function changerSaison() {
        $saisons = ["printemps", "été", "automne", "hiver"];
        $this->season = $saisons[array_rand($saisons)];
        $this->addMessage("On est en " . $this->season);
    }
}
?>
