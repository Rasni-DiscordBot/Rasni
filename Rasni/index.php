<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/Rasni.php';

use Discord\Discord;

$discord = new Discord(['token' => 'ODE2Mjk2NTA4MTY4MDc3MzUz.YD45XQ.QS_1fh1-R_yOUXptZtniGvZyqkE']);
$main = new Rasni($discord);
$main->onCommands();
$main->onEvents();
$discord->run();
