<?php

namespace HeroGame\Factory;

use HeroGame\Entity\Hero;
use HeroGame\Entity\Player;

class PlayerFactory
{
    public function createHero(): Player
    {
        $hero = new Hero();
        $hero->setHealth(rand(70, 100))
            ->setStrength(rand(70, 80))
            ->setDefence(rand(45, 55))
            ->setSpeed(rand(40, 50))
            ->setLuck(rand(10, 30))
            ->setRapidStrikeChance(Hero::RAPID_STRIKE_CHANCE)
            ->setMagicShieldChance(Hero::MAGIC_SHIELD_CHANCE);

        return $hero;
    }

    public function createBeast(): Player
    {
        $beast = new Player();
        $beast->setHealth(rand(60, 90))
            ->setStrength(rand(60, 90))
            ->setDefence(rand(40, 60))
            ->setSpeed(rand(40, 60))
            ->setLuck(rand(25, 40));

        return $beast;
    }
}
