<?php
	//系统配置信息
	class Config{
		const LOG_DIR 			= ROOT . "logs" . DS;
		const LOG_LEVEL 		= "15";

		//系统默认访问模块名
		const DEFAULT_MODULE 	= "app";
		const DEFAULT_NAME 		= "Index";
		const DEFAULT_FUNC 		= "Index";

		//redis配置
		const REDIS_HOST 		= "127.0.0.1";
		const REDIS_PORT 		= "6379";
		const REDIS_PWD 		= "";

		//微信内容配置

		/*上山
		const EVENTTOKEN 		= "";	
		const APPID				= "";
		const APPSECRET 		= "";
		*/

		//测试号
		const EVENTTOKEN 		= "";	
		const APPID				= "";
		const APPSECRET 		= "";
	}
