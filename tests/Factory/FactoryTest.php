<?php

namespace Factory;

use HeroGame\Entity\Hero;
use HeroGame\Entity\Player;
use HeroGame\Factory\PlayerFactory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testCreateHero()
    {
        $playerFactory = new PlayerFactory();

        $hero = $playerFactory->createHero();
        $this->assertInstanceOf(Hero::class, $hero);
    }

    public function testCreateBeast()
    {
        $playerFactory = new PlayerFactory();

        $hero = $playerFactory->createHero();
        $this->assertInstanceOf(Player::class, $hero);
    }
}