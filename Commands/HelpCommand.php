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
            if ($message->content == $prefix . $command) {
                $message->channel->sendMessage("", false, [
                    "title" => "Avatar",
                    "color" => 11111,
                    "image" => [
                        "url" => "{$message->author->getAvatarAttribute('gif', 2048)}"
                    ]
                ]);
            }
        });
    }
}
