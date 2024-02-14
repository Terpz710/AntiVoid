<?php

declare(strict_types=1);

namespace Terpz710\EventListener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

use Terpz710\AntiVoid;

class AntiVoidEventListener implements Listener {

    /** @var AntiVoid */
    private $plugin;

    /** @var bool */
    private $showTitles;

    /** @var bool */
    private $showSubtitles;

    public function __construct(AntiVoid $plugin) {
        $this->plugin = $plugin;
        $this->showTitles = $plugin->getConfig()->get("show_titles", true);
        $this->showSubtitles = $plugin->getConfig()->get("show_subtitles", true);
    }

    public function onPlayerMove(PlayerMoveEvent $event) : void {
        $player = $event->getPlayer();
        $y = $event->getTo()->getY();

        if ($y < 0) {
            $player->teleport($player->getWorld()->getSpawnLocation());
            $title = $this->plugin->getConfig()->get("title");
            $subtitle = $this->plugin->getConfig()->get("subtitle"");
            if ($this->showTitles) {
                $player->sendTitle($title);
            }
            if ($this->showSubtitles) {
                $player->sendSubtitle($subtitle);
            }
        }
    }
}
