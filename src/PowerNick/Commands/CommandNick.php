<?php

namespace PowerNick\Commands;

use PowerNick\PowerNick;
use PowerNick\NickAPI\NickAPI;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;

class CommandNick extends Command {

    public function __construct(PowerNick $plugin) {
        $this->plugin = $plugin;
        $this->NickAPI = new NickAPI($this->plugin);
        parent::__construct("nick", "", null);
    }

    public function execute(CommandSender $sender, $label, array $args) {
        if ($sender instanceof Player) {
            $player = $sender;
            if (isset($args[0])) {
                if ($args[0] == "auto") {
                    if ($player->hasPermission("PowerNick.nick")) {
                        $this->NickAPI->checkNick($player);
                        return;
                    }
                }
            }
        }

        $sender->sendMessage("§7-----------" . $this->plugin->prefix . "§7-----------");
        $sender->sendMessage("§7-> §6/nick auto");
        $sender->sendMessage("§7-------------[§aHelp§7]-------------");
        return;
    }

}
