<?php
	//微信通用接口及验证	
	class WxJsApi{
		
		//校验是否微信信息
		public function checkSignature(){
			if (!isset($_GET["signature"]) || !isset($_GET["timestamp"]) || !isset($_GET["nonce"])) {
				return false;
			}

			$signature = $_GET["signature"];
			$timestamp = $_GET["timestamp"];
			$nonce = $_GET["nonce"];

			$token = Config::EVENTTOKEN;
			$tmpArr = array($token, $timestamp, $nonce);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode($tmpArr);
			$tmpStr = sha1($tmpStr);

			if( $tmpStr == $signature ){
					return true;
			}else{
					return false;
			}
		}
	}
