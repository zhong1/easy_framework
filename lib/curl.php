<?php
	class Curl{

		public static function httpGet($url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($curl, CURLOPT_URL, $url);

			$res = curl_exec($curl);
			curl_close($curl);

			return $res;
		}

		public static function httpPost($url, $postData){
			$curl = curl_init();

			$header[]="Content-Type: text/xml; charset=utf-8";
			$header[]="Content-Length: " . strlen($postData);

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($curl, CURLOPT_URL, $url);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

			curl_setopt($curl,CURLOPT_POST, 1);
			curl_setopt($curl,CURLOPT_POSTFIELDS, $postData);
			$res = curl_exec($curl);
			curl_close($curl);

			return $res;
		} 

	}
