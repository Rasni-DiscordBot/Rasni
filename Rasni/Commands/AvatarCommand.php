<?php

use Discord\Parts\Embed\Embed;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;

class AvatarCommand{

    /** @var Rasni */
    private $main;

    /**
     * AvatarCommand constructor.
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

        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use($prefix, $command){
            $maincommand = $prefix . $command;
            $length = strlen($message->content);
            $length = $length - 2;
            $avatar = $message->author->avatar;
            $avatar = str_replace(".jpg", ".gif", $avatar);

            $img = $message->author->username;
            $img = file_put_contents($img, file_get_contents($avatar));
            if ($img == null){
                $img = $message->author->avatar;
            }else{
                $img = $avatar;
            }

            if (substr($message->content, 0, -$length) == $prefix){
                if ($message->content == $maincommand) {
                    $message->channel->sendMessage("", false, [
                        "title" => "Rasni",
                        "color" => 3066993,
                        "description" => "{$message->author->username}'s Avatar:",
                        "type" => Embed::TYPE_GIFV,
                        "image" => [
                            "url" => $img
                        ]
                    ]);
                    return true;
                }
                return true;
            }
            return true;
        });
    }
}
