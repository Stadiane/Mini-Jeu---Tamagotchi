<?php
namespace App\Provision;

class Watermelon extends Provision
{
    public function __construct()
    {
        $this->icon = '🍉';
        $this->nom = 'Pastèque';
        $this->healthPoints = 0;
        $this->moodPoints = 0;
        $this->hungerPoints= -20;
        $this->thirstPoints = -30;
    }
}