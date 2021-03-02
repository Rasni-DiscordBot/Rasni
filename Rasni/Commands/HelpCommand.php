<?php

use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;

class HelpCommand{

    /** @var Rasni */
    private $main;

    /**
     * HelpCommand constructor.
     * @param Rasni $main
     * @param string $command
     */
    public function __construct(Rasni $main, string $command){
        $this->main = $main;
        $this->onCommand($command);
    }

    /**
     * @param string $command
     */
    public function onCommand(string $command){
        $discord = $this->main->getBot();
        $prefix = $this->main::PREFIX;

        $discord->on(Event::MESSAGE_CREATE, function (Message $message) use($prefix, $command){
            $maincommand = $prefix . $command;
            $length = strlen($message->content);
            $length = $length - 2;

            if (substr($message->content, 0, -$length) == $prefix){
                if (!in_array($message->content, CommandManager::COMMANDS)){
                    $message->channel->sendMessage("{$message->author->username}, **{$message->content}** Not found!");
                    return false;
                }
                if ($message->content == $maincommand) {
                    $message->channel->sendMessage("", false, [
                        "title" => "Rasni",
                        "color" => "16580705",
                        "description" => "Commands\n\n{$prefix}help"
                    ]);
                    return true;
                }
                return true;
            }
            return true;
        });
    }
}
