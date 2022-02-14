<?php

namespace OnlineUI;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class OnlineUI extends PluginBase implements Listener {

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $commandname = $command;
        if($commandname == "online"){
            if($sender instanceof Player){
                $this->online($sender);
            }
        }
    return true;
    }

    public function online(Player $player){
        $form = new SimpleForm(function (Player $player, int $data = null){
            if($data === null){
                return;
            }
        });
        $form->setTitle("§9- §8Online Player §9-");
        foreach($this->getServer()->getOnlinePlayers() as $onlinePlayer){
            $p = $onlinePlayer->getName();
            $form->addButton("§8 $p");
        }
        $player->sendForm($form);
        return $form;
    }
}
