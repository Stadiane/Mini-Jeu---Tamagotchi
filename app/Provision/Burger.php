<?php
namespace App\Provision;

class Burger extends Provision
{
    public function __construct()
    {
        $this->icon = '🍔';
        $this->nom = 'Burger';
        $this->healthPoints = -10;
        $this->moodPoints = 0;
        $this->hungerPoints= -100;
        $this->thirstPoints = 30;
    }
}