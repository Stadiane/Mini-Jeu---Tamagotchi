<?php
namespace App\Provision;

class Cola extends Provision
{
    public function __construct()
    {
        $this->icon = '🥤';
        $this->nom = 'Cola';
        $this->healthPoints = 0;
        $this->moodPoints = 30;
        $this->hungerPoints= -20;
        $this->thirstPoints = -10;
    }
}