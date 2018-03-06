<?php
	//路由类
	class Route{

		public static $module;
		public static $name;
		public static $func;

		//路由注册
		public static function register(){

			self::getRoute();
			self::callMode();
		}

		//获取URI信息
		//TODO 后续可扩展此方法，达到多种路由规则
		public static function getRoute(){
			$Url = explode('/', key($_GET));

			self::$module = strtolower(isset($Url[0]) ? $Url[0] : Config::DEFAULT_MODULE);
			self::$name = ucfirst(isset($Url[1]) ? $Url[1] : Config::DEFAULT_NAME);
			self::$func = isset($Url[2]) ? $Url[2] :  Config::DEFAULT_FUNC;
		}
		
		//调用方法
		public static function callMode(){
			Loader::import(self::$name, ROOT . self::$module . DS . 'controller' . DS);
			$class = self::$name;
			$function = lcfirst(self::$func);

			//类名方法是否相同
			$obj = new $class();
			if(strtoupper($class) != strtoupper($function)){
				$obj->$function();
			}
		}

	}	
