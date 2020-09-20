<?php

namespace Services;

use HeroGame\Entity\Arena;
use HeroGame\Entity\Hero;
use HeroGame\Entity\Player;
use HeroGame\Service\GameMechanicsService;
use PHPUnit\Framework\TestCase;

class GameMechanicsServiceTest extends TestCase
{

    public function fightProvider()
    {
        $heroWins = [
            0 => 'Start: <br>',
            1 => 'Hero Starts',
            2 => 'Hero attacks Beast and inflicts 100 Damage. Beast remains with -90 health',
            3 => 'Beast Dies',
            4 => 'Hero Wins!!!',
        ];
        $beastWins = [
            0 => 'Start: <br>',
            1 => 'Beast Starts',
            2 => 'Beast attacks Hero and inflicts  100 Damage. Beast remains with -90 health',
            3 => 'Hero Dies',
            4 => 'Beast Wins!!!',
        ];

        return [
            [0, $heroWins],
            [1, $beastWins],
        ];
    }

    /**
     * @dataProvider fightProvider
     *
     * @param $startingPlayer
     * @param $expected
     */
    public function testFight($startingPlayer, $expected)
    {
        $hero = new Hero();
        $hero->setHealth(10)->setStrength(100);
        $beast = new Player();
        $beast->setHealth(10)->setStrength(100);

        $arena = new Arena();
        $arena->setHero($hero);
        $arena->setBeast($beast);
        $arena->setStartingPlayer($startingPlayer);

        $obj = new GameMechanicsService();
        $result = $obj->prepareBattle($arena)->fight()->getResult();

        $this->assertEquals($expected, $result);
    }
}