<?php
namespace App\Provision;

class Water extends Provision
{
    public function __construct()
    {
        $this->icon = '💧';
        $this->nom = 'Water';
        $this->healthPoints = 0;
        $this->moodPoints = -20;
        $this->hungerPoints = 0;
        $this->thirstPoints = -40;
    }
}
