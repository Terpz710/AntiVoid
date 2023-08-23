<?php

declare(strict_types=1);

namespace Terpz710;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Terpz710\EventListener\AntiVoidEventListener;

class AntiVoid extends PluginBase {

    public function onEnable() : void {
        $this->getLogger()->info("AntiVoid has been enabled.");
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new AntiVoidEventListener($this), $this);
    }

    public function onDisable() : void {
        $this->getLogger()->info("AntiVoid has been disabled.");
    }
}