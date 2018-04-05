<?php

namespace PowerNick\SkinAPI;

use PowerNick\PowerNick;

use pocketmine\Player;

class SkinAPI {

    public function __construct(PowerNick $plugin) {
        $this->plugin = $plugin;
    }
    
    /*
     * @param Player $player
     */

    public function setSkin(Player $player) {
        $fskin = $player->getServer()->getOnlinePlayers()[array_rand($player->getServer()->getOnlinePlayers())]->getSkinData();

        $player->setSkin($fskin, "Standard_Custom");
        $player->despawnFromAll();
        $player->spawnToAll();
    }
    
    /*
     * @param Player $player
     */

    public function delSkin(Player $player) {
        $nskin = $player->getSkinData();
        $player->setSkin($nskin, "Standard_Custom");
        $player->despawnFromAll();
        $player->spawnToAll();
    }
}
