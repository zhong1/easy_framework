<?php

	class Wx{

		public $reqObj;
		public $toUserName;
		public $fromUserName;
		public $msgType;
		public $content;
		public $msgId;

		public $resultStr = "success";
		
		//微信开发配置入口主流程，不参与具体业务
		public function start(){
			Loader::import('wx/Wx#JsApi', LIB);
			Loader::import('wx/Wx#Func', LIB);

			$wxJsApi = new WxJsApi();
			if($wxJsApi->checkSignature() != true){
				Log::WARN("Attack Request!");
				exit;
			}

			if (isset($_GET['echostr'])) {
				Log::INFO("ShakeHands OK!");
				echo $_GET['echostr'];
				exit;
			}

			if($this->getContent() == false){
				Log::WARN("getContent error");
				exit;
			}

			$this->splitBusiness();

			$this->end();
		}

		//解析请求参数
		public function getContent(){

			$postStr = file_get_contents('php://input');
			Log::INFO("postStr:" . $postStr);

			if(empty($postStr) == true){
				Log::INFO("postStr is empty");
				return false;
			}
			$reqObj = Util::xmlToObj($postStr);
			if($reqObj == false){
				$log->INFO("Load PostStr To XML Error:" . $PostStr);
				return false;
			}

			$this->reqObj 		= $reqObj;
			$this->toUserName 	= $reqObj->ToUserName;
			$this->fromUserName = $reqObj->FromUserName;
			$this->msgType 		= $reqObj->MsgType;
			$this->content 		= $reqObj->Content;
			$this->msgId 		= $reqObj->MsgId;

			return true;
		}

		//业务流程控制
		public function splitBusiness(){

			switch($this->msgType){
				case 'text':
					$this->goText();
					break;

				case 'image':
					$this->goImage();
					break;

				case 'vedio':
					$this->goVedio();
					break;

				case 'event':
					$this->goEvent();
					break;
			}
		}

		//文本内容处理
		public function goText(){
			//直接原样返回数据
			$msg 			= $this->content;
			$fromUserName 	= $this->fromUserName;
			$toUserName		= $this->toUserName;
			$this->resultStr= WxFunc::makeReturnMsg($fromUserName, $toUserName, $msg);
		}

		//图片内容处理
		public function goImage(){}

		//视频内容处理
		public function goVedio(){}

		//时间处理处理
		public function goEvent(){

		}

		//结束返回
		public function end(){
			echo $this->resultStr;
		}
	}
