<?php

namespace PowerNick;

use PowerNick\NickAPI\NickAPI;
use PowerNick\Events\onChat;
use PowerNick\Commands\CommandNick;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\lang\BaseLang;

class PowerNick extends PluginBase implements Listener {
    
    public $prefix = "§7[§ePowerNick§7] ";
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info($this->prefix . "by §6McpeBooster§7!");
        $this->saveDefaultConfig();
		$this->saveResource("how_to_use.txt");
        
        $lang = $this->getConfig()->get("language", BaseLang::FALLBACK_LANGUAGE);
        $this->baseLang = new BaseLang($lang, $this->getFile() . "resources/");
        
        $this->NickAPI = new NickAPI($this);
        
        $this->getServer()->getPluginManager()->registerEvents(new onChat($this), $this);
        
        $this->getServer()->getCommandMap()->register("Nick", new CommandNick($this));
    }
    
    public function getLanguage() : BaseLang {
        return $this->baseLang;
    }
}
