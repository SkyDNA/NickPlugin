<?php

namespace PowerNick\NickAPI;

use PowerNick\PowerNick;
use PowerNick\SkinAPI\SkinAPI;
use pocketmine\Player;

class NickAPI {

    public $nicks = array();

    public function __construct(PowerNick $plugin) {
        $this->plugin = $plugin;
        $this->SkinClass = new SkinAPI($this->plugin);
    }

    /*
     * @param Player $player
     */

    public function checkNick(Player $player) {
        $name = $player->getName();
        $nick = $player->getDisplayName();
        if ($name === $nick) {
            $this->setNick($player);
        } else {
            $this->delNick($player);
        }
    }

    /*
     * @param Player $player
     */

    public function setNick(Player $player) {
        $name = $player->getName();
        $name = $player->getName();
        $nicks = $this->plugin->getConfig()->get("allnick");
        $rnick = array_rand($nicks);
        $fnick = $nicks[$rnick];

        $nickformat = $this->plugin->getConfig()->get("nametag");
        $nickformat = str_replace("{nickname}", $fnick, $nickformat);

        $player->setNameTag($nickformat);
        $player->setDisplayName($fnick);

        $msg = $this->plugin->getLanguage()->get("player.nick.on");
        $msg = str_replace("{nick}", $fnick, $msg);
        $player->sendMessage($this->plugin->prefix . $msg);

        $this->SkinClass->setSkin($player);
    }

    /*
     * @param Player $player
     */

    public function delNick(Player $player) {

        $name = $player->getName();

        $player->setDisplayName($name);

        $player->sendMessage($this->plugin->prefix . $this->plugin->getLanguage()->get("player.nick.off"));

        $this->SkinClass->delSkin($player);
    }

    public function isNick($player) {
        $name = $player->getName();
        $nick = $player->getDisplayName();

        if (!$name == $nick) {
            return "nicked";
        }
        return "normal";
    }

}
