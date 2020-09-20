<?php

namespace HeroGame\Service;

use HeroGame\Entity\Arena;

class GameMechanicsService
{
    /**
     * @var Arena
     */
    private $arena = null;

    /**
     * @var array
     */
    private $result = [];

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param array $result
     * @return GameMechanicsService
     */
    public function setResult(array $result): GameMechanicsService
    {
        $this->result = $result;
        return $this;
    }

    public function prepareBattle(Arena $arena)
    {
        $this->arena = $arena;
        return $this;
    }

    public function fight()
    {
        $this->result[] = 'Start: <br>';
        $startingPlayer = $this->arena->getStartingPlayer();
        if ($startingPlayer == 0) {
            $this->result[] = 'Hero Starts';
        } else {
            $this->result[] = 'Beast Starts';
        }

        while ($this->arena->getHero()->getHealth() > 0 && $this->arena->getBeast()->getHealth() > 0) {
            $heroStrength = $this->arena->getHero()->getStrength();
            $beastStrength = $this->arena->getBeast()->getStrength();

            $heroDamage = $this->arena->getHero()->calculateDamage($heroStrength);
            $beastDamage = $this->arena->getBeast()->calculateDamage($beastStrength);

            if ($startingPlayer == 0) {
                $this->arena->getBeast()->updateHealth($heroDamage);
                $this->result[] = "Hero attacks Beast and inflicts " . $heroDamage . " Damage. Beast remains with " . $this->arena->getBeast()->getHealth() . " health";
                if ($this->arena->getBeast()->getHealth() < 0) {
                    break;
                }
                $this->arena->getHero()->updateHealth($beastDamage);
                $this->result[] = "Beast attacks Hero and inflicts " . $beastDamage . " Damage. Hero remains with " . $this->arena->getHero()->getHealth() . " health <br>";
            } else {
                $this->arena->getHero()->updateHealth($beastDamage);
                $this->result[] = "Beast attacks Hero and inflicts  " . $beastDamage . " Damage. Hero remains with " . $this->arena->getHero()->getHealth() . " health";
                if ($this->arena->getHero()->getHealth() < 0) {
                    break;
                }
                $this->arena->getBeast()->updateHealth($heroDamage);
                $this->result[] = "Hero attacks Beast and inflicts " . $heroDamage . " Damage. Beast remains with " . $this->arena->getBeast()->getHealth() . " health <br>";
            }
        }

        if ($this->arena->getHero()->getHealth() > 0) {
            $this->result[] = "Beast Dies";
            $this->result[] = "Hero Wins!!!";
        } else {
            $this->result[] = "Hero Dies";
            $this->result[] = "Beast Wins!!!";
        }

        return $this;
    }
}
