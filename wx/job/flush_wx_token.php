<?php
	//项目入口文件  
    ini_set('display_errors','On');

    define('DS', DIRECTORY_SEPARATOR);
    define('EXT', ".php");
    define("ROOT", dirname(dirname(dirname(__FILE__))) . DS);
    define("LIB", ROOT . "lib" . DS);
    define("INC", ROOT . "inc" . DS);

    require_once LIB . "loader.php";

    Loader::register();
    Loader::import('Config', INC);
    Loader::import('Log', LIB);

	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='. Config::APPID .'&secret=' . Config::APPSECRET;
	$resObj = Curl::httpGet($url);
	$resArr = json_decode($resObj, true);

	if(!isset($resArr['access_token'])){
		echo "access_token error";die;
	}
	$accessToken = $resArr['access_token'];

	$rdsObj = Rds::getInstance();
	$rdsObj->setToken($accessToken);
