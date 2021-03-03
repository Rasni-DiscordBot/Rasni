<?php

include __DIR__ . "/HelpCommand.php";
include __DIR__ . "/AvatarCommand.php";

class CommandManager{

    /** @var string[] */
    const COMMANDS = [
        Rasni::PREFIX . "help",
        Rasni::PREFIX . "avatar"
    ];

    public static function registerCommands(){
        $commands = self::getCommands();
        $countcommand = self::getCountCommands($commands);
        $discord = Rasni::getBot();

        $discord->on('ready', function () use($countcommand) {
            echo "Successfully setup Rasni Bot!\n";
            echo "{$countcommand} command file processed!\n";
        });
    }

    /**
     * @return HelpCommand[]
     */
    public static function getCommands(){
        $discord = Rasni::getBot();
        return [
            new HelpCommand(new Rasni($discord), "help"),
            new AvatarCommand(new Rasni($discord), "avatar")
        ];
    }

    /**
     * @return int
     */
    public static function getCountCommands($commands){
        return count($commands);
    }
}
