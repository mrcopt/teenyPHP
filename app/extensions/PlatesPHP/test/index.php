<?php

require 'autoload.php';


use League\Plates\{Engine, Template\Theme};

$plates = Engine::fromTheme(Theme::hierarchy([
    Theme::new('templates/main', 'Main'), // parent
    Theme::new('templates/user', 'User'), // child
    Theme::new('templates/seasonal', 'Seasonal'), // child2
]));

$templates->render('home'); // templates/main/home.php
//$templates->render('layout'); // templates/user/layout.php
//$templates->render('header'); // templates/seasonal/header.php