<?php
	//微信回复类方法
	class WxFunc{
			// 构成文本返回消息
			public static function makeReturnMsg($userOpenID, $myOpenID, $msg) {
					$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";

					$resXML = sprintf($textTpl, $userOpenID, $myOpenID, time(), $msg);

					return($resXML);
			}
	}
