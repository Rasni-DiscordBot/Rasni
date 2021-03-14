<?php

use Discord\Discord;
use Discord\Parts\User\Activity;

class ActivityEvent{

    /** @var Rasni */
    private $main;

    /**
     * ActivityEvent constructor.
     * @param Rasni $main
     */
    public function __construct(Rasni $main){
        $this->main = $main;
        $this->onEvent();
    }

    public function onEvent(){
        $discord = $this->main->getBot();
        $prefix = $this->main::PREFIX;

        $discord->on('ready', function (Discord $discord) use($prefix){
            $activity = $discord->factory(Activity::class, [
                'name' => $prefix,
                'type' => Activity::TYPE_PLAYING
            ]);
            $discord->updatePresence($activity);
            $this->onEvent();
            return true;
        });
    }
}
