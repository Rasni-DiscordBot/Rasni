<?php

include __DIR__ . "/HelpCommand.php";

class CommandManager{

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
            new HelpCommand(new Rasni($discord), "help")
        ];
    }

    /**
     * @return int
     */
    public static function getCountCommands($commands){
        return count($commands);
    }
}
