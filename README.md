简单实现面向对象框架：
	通用入口放在public/index.php	可修改此入口，只需更改常量目录定义即可

1、目录结构
	inc
		config.php		配置文件
	lib
		loader.php		类自动加载文件	后续可扩展此类，实现更多规则加载	
		route.php		路由调用实现	后续可扩展此类，实现多种路由规则调用(重要)
		curl.php		http调用方法
		log.php			日志打印
		rds.php			redis调用
		util.php		工具类
	logs
	public
		index.php
	wx
		conf
		controller
		model
		views
		job


2、nginx配置
	#保证最后重定向到public入口文件
    location ~* ^/.*$
    {
        rewrite ^/(.*) /index.php?$1 last;
        break;
    }

后续实现抽象数据库访问层；调用公共DB类实现(mysql PDO方式)

http://idea.lanyus.com/

