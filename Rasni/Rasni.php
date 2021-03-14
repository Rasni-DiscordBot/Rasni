<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/Commands/CommandManager.php';
include __DIR__ . '/Events/EventManager.php';

use Discord\Discord;

class Rasni{

    /** @var string[] */
    const HELLOMESSAGES = [
        // Türkçe / Turkish
        "Sa" => "Aleyküm Selam, Hoşgeldin!",
        "Selamun Aleyküm" => "Aleyküm Selam, Hoşgeldin!",
        // İngilizce / English
        "Hello" => "Hi, Welcome!",
        "Hi" => "Hi, Welcome!"
    ];

    /** @var string */
    const PREFIX = "r!";

    /** @var Discord */
    private static $discord;

    /**
     * index constructor.
     * @param Discord $discord
     */
    public function __construct(Discord $discord){
        self::$discord = $discord;
    }

    /**
     * @return Discord
     */
    public static function getBot(){
        return self::$discord;
    }

    public function onCommands(){
        CommandManager::registerCommands();
    }

    public function onEvents(){
        EventManager::registerEvents();
    }
}
