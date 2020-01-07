<?php

namespace main;

/*base*/
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
/**/
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;


class main extends PLuginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("§aNGwordが読み込まれました。");
			if(!file_exists($this->getDataFolder())){
				@mkdir($this->getDataFolder(),0744,true);
			}
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array("NGワード"=>["",""]));
	}
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		$chat = $event->getMessage();
		$word = $this->config->get("NGワード");
			foreach($word as $ng){
				if(mb_strpos($chat,$ng) !== false){
					$event->setCancelled();
					$player->sendMessage("§c⚠NGワードが含まれている為送信できません");
				}
			}
	}
	public function onDisable(){
		$this->getLogger()->info("§cNGwordが終了しました。");
	}
}