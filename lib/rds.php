<?php
	//redis操作类
	class Rds{
		
		public $redisObj;
		public static $instance;

		private function __construct(){
			$this->redisObj = new Redis();
			$this->redisObj->connect(Config::REDIS_HOST, Config::REDIS_PORT);		
			$this->redisObj->auth(Config::REDIS_PWD);
		}

		//获取redis操作实例
		public static function getInstance(){
			if(!(self::$instance instanceof self)){
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function setToken($token){
			try{
				$this->redisObj->set("wx_access_token", $token);
				$this->redisObj->expire("wx_access_token", 7200);
				return(true);
			
			}catch(Exception $e){
				return("");
			}
		}
		
		public function getToken(){
			try{
				$Res = $this->redisObj->get("wx_access_token");
				if ($Res == "")
				{
					return("");
				}
			} catch(Exception $e){
				return("");
			}
			return $Res;
		}
	}	
