<?php
	
	//微信标签
	class Tag{
	
		public static $wxToken = "";

		public static function getWxToken(){

			if(empty(self::$wxToken)){
				$rdsObj = Rds::getInstance();
				self::$wxToken = $rdsObj->getToken();
			}
			return self::$wxToken;
		}	
	
		//获取当前公众号所有标签
        function getLabel(){
            $token = self::getWxToken();
            $url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token=' . $token;

            $res = Curl::httpGet($url);
            $resObj = json_decode($res, true);
			print_r($resObj);die;
            if(!isset($ResObj['tags'])){
                Log::WARN(__FUNCTION__ . "ERROR ,MSG:". $res);
                return false;
            }
            echo json_encode($resObj);
        }

		//创建标签
        function createLabel(){
			if(!isset($_GET['name'])){
				echo "parmas name error";exit;
			}
			$name = $_GET['name'];

            $token = self::getWxToken();
            $url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token=' . $token;

            $reqObj = array();
            $reqObj['tag']['name'] = $name;
			print_r(json_encode($reqObj, JSON_UNESCAPED_UNICODE));die;

            $res = Curl::httpPost($url, json_encode($reqObj, JSON_UNESCAPED_UNICODE));
            $resObj = json_decode($res, true);
            if(!isset($resObj['tag'])){
                Log::WARN(__FUNCTION__ . " ERROR ,MSG:". $res);
                return false;
            }
            echo json_encode($resObj);
        }

	}
