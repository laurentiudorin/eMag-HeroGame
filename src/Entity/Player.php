<?php

namespace HeroGame\Entity;

class Player
{
    /** @var int */
    protected $health = 0;
    /** @var int */
    protected $strength = 0;
    /** @var int */
    protected $defence = 0;
    /** @var int */
    protected $speed = 0;
    /** @var int */
    protected $luck = 0;

    /**
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return Player
     */
    public function setHealth(int $health)
    {
        $this->health = $health;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return Player
     */
    public function setStrength(int $strength)
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     * @return Player
     */
    public function setDefence(int $defence)
    {
        $this->defence = $defence;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return Player
     */
    public function setSpeed(int $speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return int
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param int $luck
     * @return Player
     */
    public function setLuck(int $luck)
    {
        $this->luck = $luck;
        return $this;
    }

    public function updateHealth(int $damage)
    {
        $this->health -= $damage;
    }

    public function calculateDamage($attackerStrength)
    {
        $damage = $attackerStrength - $this->defence;
        if (rand(0, 100) <= $this->luck) {
            $damage = 0;
        }
        return $damage > 0 ? $damage : 0;
    }
}
