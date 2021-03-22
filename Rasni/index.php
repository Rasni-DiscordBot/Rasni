<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/Rasni.php';

use Discord\Discord;

$discord = new Discord(['token' => '~~~']);
$main = new Rasni($discord);
$main->onCommands();
$main->onEvents();
$discord->run();
