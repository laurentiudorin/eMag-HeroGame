<?php

namespace HeroGame\Controller;

use HeroGame\Service\ArenaBuilderService;
use HeroGame\Service\GameMechanicsService;

class DefaultController
{

    /**
     * @var ArenaBuilderService
     */
    private $arenaBuilderService = null;
    /**
     * @var GameMechanicsService
     */
    private $gameMechanicsService = null;


    public function __construct()
    {
        $this->arenaBuilderService = new ArenaBuilderService();
        $this->gameMechanicsService = new GameMechanicsService();
    }

    public function index()
    {
        $arena = $this->arenaBuilderService->createArena()
            ->addHero()
            ->addEnemy()
            ->setOrder()
            ->getArena();

        $result = $this->gameMechanicsService->prepareBattle($arena)
            ->fight()
            ->getResult();

        foreach ($result as $item) {
            echo $item . "<br>";
        }
    }
}
