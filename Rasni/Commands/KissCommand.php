<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;

class KissCommand{

    /** @var Rasni */
    private $main;

    /**
     * KissCommand constructor.
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
            $user = explode(" ", $message->content);
            if (!isset($user[1])){
                $user[1] = $message->author;
            }
            $maincommand = $prefix . $command;
            $length = strlen($message->content);
            $length = $length - 2;

            if (substr($message->content, 0, -$length) == $prefix){
                if ($message->content == $maincommand . " " . $user[1]) {
                    $rand = [
                        "https://media.tenor.com/images/e5aea3ce41ccba63f9157ecf8ec6346d/tenor.gif",
                        "https://media.tenor.com/images/d4f7e50a9851da8c35a158e36e2af1f9/tenor.gif",
                        "http://33.media.tumblr.com/1ca71b01f4de7ff8f59cb4d92f696e75/tumblr_n9r22s3pwl1r7eta3o1_400.gif",
                        "https://acegif.com/wp-content/uploads/passionate-40.gif",
                        "https://media.tenor.com/images/7014f6895fb6fa04c45821acfae6e072/tenor.gif",
                        "https://38.media.tumblr.com/332f61dbe5d0fdf22cb85afb5c477120/tumblr_nkwysbQjvZ1uo0fjdo1_500.gif",
                        "https://media4.giphy.com/media/l2Je2M4Nfrit0L7sQ/giphy.gif"
                    ];
                    $rand = $rand[array_rand($rand)];
                    $message->channel->sendMessage("", false, [
                        "title" => "Rasni - Kiss",
                        "color" => "10181046",
                        "description" => "{$user[1]} kissed by {$message->author}",
                        "image" => [
                            "url" => $rand
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
