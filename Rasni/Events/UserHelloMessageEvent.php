<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;

class UserHelloMessageEvent{

    /** @var Rasni */
    private $main;

    /**
     * UserHelloMessageEvent constructor.
     * @param Rasni $main
     */
    public function __construct(Rasni $main){
        $this->main = $main;
        $this->onEvent();
    }

    public function onEvent(){
        $discord = $this->main->getBot();

        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord){
            foreach ($this->main::HELLOMESSAGES as $messages => $submessages){
                $array = array($messages);
                if (in_array($message->content, $array)){
                    $message->channel->sendMessage($this->main::HELLOMESSAGES[$message->content]);
                    return true;
                }
            }
            return true;
        });
    }
}
