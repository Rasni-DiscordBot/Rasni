<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/Commands/CommandManager.php';

use Discord\Discord;
use Discord\Parts\User\Activity;
use Discord\Parts\User\Member;
use Discord\WebSockets\Event;

class Rasni{

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
        $this->onBotActivity();
        $this->onUserJoin();
        $this->onUserLeave();
    }

    /**
     * @throws \Exception
     */
    public function onBotActivity(){
        $discord = Rasni::getBot();

        $discord->on('ready', function (Discord $discord){
            $activity = $discord->factory(Activity::class, [
                'name' => self::PREFIX,
                'type' => Activity::TYPE_PLAYING
            ]);
            $discord->updatePresence($activity);
        });
    }

    public function onUserJoin(){
        $discord = Rasni::getBot();

        $discord->on(Event::GUILD_MEMBER_ADD, function (Member $member, Discord $discord){

        });
    }

    public function onUserLeave(){
        $discord = Rasni::getBot();

        $discord->on(Event::GUILD_MEMBER_ADD, function () {

        });
    }
}
