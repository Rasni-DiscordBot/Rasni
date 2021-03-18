<?php

include __DIR__ . "/HelpCommand.php";
include __DIR__ . "/AvatarCommand.php";
include __DIR__ . "/HeadsOrTailsGameCommand.php";
include __DIR__ . "/KissCommand.php";

class CommandManager{

    /** @var string[] */
    const COMMANDS = [
        Rasni::PREFIX . "help",
        Rasni::PREFIX . "avatar",
        Rasni::PREFIX . "headsortails",
        Rasni::PREFIX . "kiss"
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
     * @return array
     */
    public static function getCommands(){
        $discord = Rasni::getBot();
        return [
            new HelpCommand(new Rasni($discord), "help"),
            new AvatarCommand(new Rasni($discord), "avatar"),
            new HeadsOrTailsGameCommand(new Rasni($discord), "headsortails"),
            new KissCommand(new Rasni($discord), "kiss")
        ];
    }

    /**
     * @return int
     */
    public static function getCountCommands($commands){
        return count($commands);
    }
}
