<?php

include __DIR__ . "/ActivityEvent.php";
include __DIR__ . "/UserHelloMessageEvent.php";

class EventManager{

    public static function registerEvents(){
        $events = self::getEvents();
        $countevent = self::getCountEvents($events);
        $discord = Rasni::getBot();

        $discord->on('ready', function () use($countevent) {
            echo "{$countevent} event file processed!\n";
        });
    }

    /**
     * @return array
     */
    public static function getEvents(){
        $discord = Rasni::getBot();
        return [
            new ActivityEvent(new Rasni($discord)),
            new UserHelloMessageEvent(new Rasni($discord))
        ];
    }

    /**
     * @return int
     */
    public static function getCountEvents($events){
        return count($events);
    }
}
