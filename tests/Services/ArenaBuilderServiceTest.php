<?php

namespace Services;

use HeroGame\Entity\Arena;
use HeroGame\Entity\Hero;
use HeroGame\Entity\Player;
use HeroGame\Service\ArenaBuilderService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

class ArenaBuilderServiceTest extends TestCase
{
    public function testCreateArena()
    {
        $arenaBuilder = new ArenaBuilderService();
        $arenaBuilder->createArena();
        $arena = $arenaBuilder->getArena();
        $this->assertInstanceOf(Arena::class, $arena);
    }

    /**
     * @depends testCreateArena
     */
    public function testAddHero()
    {
        $arenaBuilder = new ArenaBuilderService();
        $arenaBuilder->createArena()->addHero();
        $hero = $arenaBuilder->getArena()->getHero();
        $this->assertInstanceOf(Hero::class, $hero);
        $this->assertNotEmpty($hero->getHealth());
        $this->assertNotEmpty($hero->getStrength());
        $this->assertNotEmpty($hero->getSpeed());
        $this->assertNotEmpty($hero->getLuck());
        $this->assertNotEmpty($hero->getDefence());
        $this->assertNotEmpty($hero->getMagicShieldChance());
        $this->assertNotEmpty($hero->getRapidStrikeChance());
    }

    /**
     * @depends testCreateArena
     */
    public function testAddBeast()
    {
        $arenaBuilder = new ArenaBuilderService();
        $arenaBuilder->createArena()->addHero();
        $beast = $arenaBuilder->getArena()->getHero();
        $this->assertInstanceOf(Hero::class, $beast);
        $this->assertNotEmpty($beast->getHealth());
        $this->assertNotEmpty($beast->getStrength());
        $this->assertNotEmpty($beast->getSpeed());
        $this->assertNotEmpty($beast->getLuck());
        $this->assertNotEmpty($beast->getDefence());
        $this->assertNotEmpty($beast->getMagicShieldChance());
        $this->assertNotEmpty($beast->getRapidStrikeChance());
    }


    public function setOrderProvider()
    {
        return [
            [100, 0, 10, 0, 0],
            [10, 0, 100, 0, 1],
            [10, 100, 10, 10, 0],
            [10, 10, 10, 100, 1],
            [10, 10, 10, 10, null],
        ];
    }

    /**
     * @dataProvider setOrderProvider
     *
     * @param $hSpeed
     * @param $hLuck
     * @param $bSpeed
     * @param $bLuck
     * @param $expected
     *
     * @throws ReflectionException
     */
    public function testSetOrder($hSpeed, $hLuck, $bSpeed, $bLuck, $expected)
    {
        $hero = new Hero();
        $hero->setSpeed($hSpeed)->setLuck($hLuck);
        $beast = new Player();
        $beast->setSpeed($bSpeed)->setLuck($bLuck);

        $arena = new Arena();
        $arena->setHero($hero);
        $arena->setBeast($beast);

        $obj = new ArenaBuilderService();
        $class = new ReflectionClass($obj);
        $property = $class->getProperty("arena");
        $property->setAccessible(true);
        $property->setValue($obj, $arena);


        $startingPlayer = $obj->setOrder()->getArena()->getStartingPlayer();
        if (is_null($expected))
        {
            $this->assertIsInt($startingPlayer);
        } else {
            $this->assertEquals($expected, $startingPlayer);
        }

    }


}