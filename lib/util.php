<?php
	class Util{
	
		public static function xmlToObj($xmlStr){
			return simplexml_load_string($xmlStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		}
	}
