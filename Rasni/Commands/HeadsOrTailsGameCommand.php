<?php

use Discord\Parts\Channel\Message;
use Discord\Parts\WebSockets\MessageReaction;
use Discord\WebSockets\Event;
use Discord\Discord;

class HeadsOrTailsGameCommand{

    /** @var Rasni */
    private $main;

    /** @var array */
    private $players = [];

    /**
     * HeadsOrTailsGameCommand constructor.
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

            if (substr($message->content, 0, -$length) == $prefix){
                if ($message->content == $maincommand) {
                    $message->channel->sendMessage("", false, [
                        "title" => "Rasni - Heads Or Tails",
                        "color" => "15844367",
                        "description" => "**Is it heads or tails ?**\n\nHeads: 🪙 | Tails: 🧑"
                    ])->done(function (Message $mess) use ($message){
                        $mess->react("🪙");
                        $mess->react("🧑");
                        $this->players[] = $message->author->id;
                        return true;
                    });

                    $discord->on(Event::MESSAGE_REACTION_ADD, function (MessageReaction $reaction, Discord $discord) use ($message){
                        if (in_array($message->author->id, $this->players)){
                            if ($reaction->emoji == "🧑") {
                                if ($reaction->user_id == 816296508168077353) return false;
                                $newplayer = ["Selected" => ":adult:"];
                                $this->players[$message->author->id] = $newplayer;
                                $this->playingGame($message->author->id, $reaction->message);
                            }elseif ($reaction->emoji == "🪙") {
                                if ($reaction->user_id == 816296508168077353) return false;
                                $newplayer = ["Selected" => ":coin:"];
                                $this->players[$message->author->id] = $newplayer;
                                $this->playingGame($message->author->id, $reaction->message);
                            }
                        }
                        return true;
                    });
                    return true;
                }
                return true;
            }
            return true;
        });
    }

    /**
     * @param int $id
     * @param $message
     * @return bool
     */
    public function playingGame(int $id, $message): bool{
        $array = [":adult:", ":coin:"];
        $rand = array_rand($array);
        $emoji = null;

        if ($rand == 0){
            $emoji = ":adult:";
        }elseif($rand == 1){
            $emoji = ":coin:";
        }

        if ($this->players[$id]) {
            if ($emoji == $this->players[$id]["Selected"]){
                $message->channel->sendMessage("", false, [
                    "title" => "Rasni - Heads Or Tails",
                    "color" => "15844367",
                    "description" => "**You WIN!**"
                ])->done(function (Message $mess) use($message){
                    sleep(5);
                    $mess->channel->deleteMessages([
                        $mess->id,
                        $message->id
                    ]);
                });
                unset($this->players[array_search($id, $this->players)]);
                return true;
            }else{
                $message->channel->sendMessage("", false, [
                    "title" => "Rasni - Heads Or Tails",
                    "color" => "15844367",
                    "description" => "**You Didn't Win, Try Again!**"
                ])->done(function (Message $mess) use($message){
                    sleep(5);
                    $mess->channel->deleteMessages([
                        $mess->id,
                        $message->id
                    ]);
                });
                unset($this->players[array_search($id, $this->players)]);
                return true;
            }
        }
        return true;
    }
}
