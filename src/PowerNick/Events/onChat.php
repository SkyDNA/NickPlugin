<?php

namespace PowerNick\Events;

use PowerNick\PowerNick;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;

class onChat implements Listener {

    public function __construct(PowerNick $plugin) {
        $this->plugin = $plugin;
    }
    
    public function onChat(PlayerChatEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        $nick = $player->getDisplayName();
        if(!($name == $nick)){
            $msg = $event->getMessage();
            $chatformat = $this->plugin->getConfig()->get("chatformat");
            $chatformat = str_replace("{nickname}", $nick, $chatformat);
            $chatformat = str_replace("{message}", $msg, $chatformat);
            $event->setFormat($chatformat);
        }
    }
    
}
