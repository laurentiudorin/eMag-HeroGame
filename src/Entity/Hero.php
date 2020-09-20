<?php

namespace HeroGame\Entity;

class Hero extends Player
{
    const HERO_NAME = 'Orderus';

    const RAPID_STRIKE_CHANCE = 10;
    const MAGIC_SHIELD_CHANCE = 20;

    protected $rapidStrikeChance = 0;
    protected $magicShieldChance = 0;

    /**
     * @return int
     */
    public function getRapidStrikeChance()
    {
        return $this->rapidStrikeChance;
    }

    /**
     * @param int $rapidStrikeChance
     * @return Hero
     */
    public function setRapidStrikeChance($rapidStrikeChance)
    {
        $this->rapidStrikeChance = $rapidStrikeChance;
        return $this;
    }

    /**
     * @return int
     */
    public function getMagicShieldChance()
    {
        return $this->magicShieldChance;
    }

    /**
     * @param int $magicShieldChance
     * @return Hero
     */
    public function setMagicShieldChance(int $magicShieldChance)
    {
        $this->magicShieldChance = $magicShieldChance;
        return $this;
    }

    public function updateHealth(int $damage)
    {
        if (rand(0, 100) <= $this->magicShieldChance) {
            $damage /= 2;
        }
        $this->health -= $damage;
    }

    public function calculateDamage($attackerStrength)
    {
        $damage = $attackerStrength - $this->defence;
        if (rand(0, 100) <= $this->magicShieldChance) {
            $damage *= 2;
        }
        if (rand(0, 100) <= $this->luck) {
            $damage = 0;
        }
        return $damage > 0 ? $damage : 0;
    }
}
