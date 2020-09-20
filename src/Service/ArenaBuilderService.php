<?php

namespace HeroGame\Service;

use HeroGame\Entity\Arena;
use HeroGame\Factory\PlayerFactory;

class ArenaBuilderService
{
    /**
     * @var PlayerFactory
     */
    private $playerFactory;

    /**
     * @var Arena
     */
    private $arena;

    /**
     * @var int
     */
    private $startingPlayer;

    public function __construct()
    {
        $this->playerFactory = new PlayerFactory();
    }

    /**
     * @return Arena
     */
    public function getArena(): Arena
    {
        return $this->arena;
    }

    public function createArena()
    {
        $this->arena = new Arena();
        return $this;
    }

    public function addHero()
    {
        $hero = $this->playerFactory->createHero();
        $this->arena->setHero($hero);
        return $this;
    }

    public function addEnemy()
    {
        $beast = $this->playerFactory->createBeast();
        $this->arena->setBeast($beast);
        return $this;
    }

    public function setOrder()
    {
        $this->startingPlayer = null;
        $this->determineOrderBySpeed();
        $this->determineOrderByLuck();

        if (is_null($this->startingPlayer)) {
            $this->startingPlayer = rand(0, 1);
        }

        $this->arena->setStartingPlayer($this->startingPlayer);
        return $this;
    }

    private function determineOrderBySpeed()
    {
        $hero = $this->arena->getHero();
        $beast = $this->arena->getBeast();
        if ($hero->getSpeed() > $beast->getSpeed()) {
            $this->startingPlayer = 0;
        } elseif ($hero->getSpeed() < $beast->getSpeed()) {
            $this->startingPlayer = 1;
        }
    }

    private function determineOrderByLuck()
    {
        if (!is_null($this->startingPlayer)) {
            return;
        }
        $hero = $this->arena->getHero();
        $beast = $this->arena->getBeast();
        if ($hero->getLuck() > $beast->getLuck()) {
            $this->startingPlayer = 0;
        } elseif ($hero->getLuck() < $beast->getLuck()) {
            $this->startingPlayer = 1;
        }
    }
}
