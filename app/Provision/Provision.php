<?php

namespace App\Provision;

abstract class Provision
{
    protected $icon;
    protected $nom;

    protected $healthPoints;
    protected $moodPoints;
    protected $hungerPoints;
    protected $thirstPoints;

    public function getName()
{
    return $this->nom;
}

public function getIcon()
{
    return $this->icon;
}
    public function getHealthPoints()
    {
        return $this->healthPoints;
    }

    public function getMoodPoints()
    {
        return $this->moodPoints;
    }

    public function getHungerPoints()
    {
        return $this->hungerPoints;
    }

    public function getThirstPoints()
    {
        return $this->thirstPoints;
    }

}