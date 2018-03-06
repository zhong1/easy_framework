<?php
	//项目入口文件	
	ini_set('display_errors','On');

	define('DS', DIRECTORY_SEPARATOR);
	define('EXT', ".php");
	define("ROOT", dirname(dirname(__FILE__)) . DS);
	define("LIB", ROOT . "lib" . DS);
	define("INC", ROOT . "inc" . DS);

	require_once LIB . "loader.php";
	
	Loader::register();
	Loader::import('Config', INC);
	Loader::import('Log', LIB);

	$logHandler= new CLogFileHandler(Config::LOG_DIR . "/gigik.log");
	$log = Log::Init($logHandler, Config::LOG_LEVEL);

	//路由规则定义	模块名/类名/方法名 模式调用
	Route::register();


	
