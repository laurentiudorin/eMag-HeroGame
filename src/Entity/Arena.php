<?php

namespace HeroGame\Entity;

class Arena
{
    /**
     * @var Hero
     */
    private $hero;

    /**
     * @var Player
     */
    private $beast;

    /**
     * @var int
     */
    private $startingPlayer;

    /**
     * @return null
     */
    public function getHero()
    {
        return $this->hero;
    }

    /**
     * @param Hero $hero
     * @return Arena
     */
    public function setHero(Hero $hero)
    {
        $this->hero = $hero;
        return $this;
    }

    public function addPlayer(Player $player)
    {
        $this->hero[] = $player;
    }

    /**
     * @return Player
     */
    public function getBeast(): Player
    {
        return $this->beast;
    }

    /**
     * @param Player $beast
     * @return Arena
     */
    public function setBeast(Player $beast): Arena
    {
        $this->beast = $beast;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartingPlayer(): int
    {
        return $this->startingPlayer;
    }

    /**
     * @param int $startingPlayer
     * @return Arena
     */
    public function setStartingPlayer(int $startingPlayer): Arena
    {
        $this->startingPlayer = $startingPlayer;
        return $this;
    }
}
