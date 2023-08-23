<?php

declare(strict_types=1);

namespace Terpz710\EventListener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerRespawnEvent;
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
            // Teleport the player back to the world spawn
            $player->teleport($player->getWorld()->getSpawnLocation());

            // Get title and subtitle from config
            $title = $this->plugin->getConfig()->get("title", "You got saved!");
            $subtitle = $this->plugin->getConfig()->get("subtitle", "You have been teleported back to the spawn.");

            // Send title and subtitle messages if enabled
            if ($this->showTitles) {
                $player->sendTitle($title);
            }

            if ($this->showSubtitles) {
                $player->sendSubtitle($subtitle);
            }
        }
    }

    public function onPlayerRespawn(PlayerRespawnEvent $event) : void {
        $player = $event->getPlayer();
        // Teleport the player back to the world spawn when they respawn
        $player->teleport($player->getWorld()->getSpawnLocation());

        // Get title and subtitle from config
        $title = $this->plugin->getConfig()->get("title", "You got saved!");
        $subtitle = $this->plugin->getConfig()->get("subtitle", "You have been teleported back to the spawn.");

        // Send title and subtitle messages if enabled
        if ($this->showTitles) {
            $player->sendTitle($title);
        }

        if ($this->showSubtitles) {
            $player->sendSubtitle($subtitle);
        }
    }
}