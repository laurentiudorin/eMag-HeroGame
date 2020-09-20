<?php
require 'vendor/autoload.php';

use HeroGame\Controller\DefaultController;

$container = new DefaultController();
$container->index();