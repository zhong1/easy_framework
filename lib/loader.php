<?php
	//简单实现类库自动加载机制，类名与文件名必须保持一致
	//后续通过扩展fineFile方法，可以实现更多中加载方式

	class Loader{
		
		/**
		 * 注册自动加载机制
		 * @access public
		 * @param  callable $autoload 自动加载处理方法
		 * @return void
		 */	
		public static function register($autoload = null){
			//注册系统自动加载
			spl_autoload_register($autoload ?: 'Loader::autoload', true, true);	
		}

		/**
		 * 自动加载
		 * @access public
		 * @param  string $class 类名
		 * @return bool
		 */
		public static function autoload($class){
			if($file = self::findFile(strtolower($class))){
				self::include_file($file);
				return true;
			}
			return false;
		}
		
		//TODO 后期可自定义规则进行查找文件
		public static function findFile($class){
			if(is_file(LIB . $class . EXT)){
				return LIB . $class . EXT;
            }
			return false;
		}		
		
		/**
		 * include
		 * @param  string $file 文件路径
		 * @return mixed
		 */
		public static function include_file($file)
		{
			return require_once($file);
		}

		//import引入文件
		public static function import($class, $baseDir = '', $ext = EXT){
			
			$class = str_replace("#", ".", $class);
			if(!file_exists($baseDir . strtolower($class) . $ext)){
				echo "not found " . strtolower($class) . $ext;die;
			}
			return self::include_file($baseDir . strtolower($class) . $ext);
		}
		
	}	
