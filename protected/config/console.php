<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//获取url

// $hostInfo = $_SERVER['HTTP_HOST'];
// $newHostInfo = str_replace('http://', '', $hostInfo);
// //获取域名前缀
// $hostQian = substr($newHostInfo,0,strpos($newHostInfo,'.'));
// $host = str_replace($hostQian.'.', '', $newHostInfo);
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'ebenchu',

	'language' => 'zh_cn',
	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.extensions.shuiyin.Image', //水印
		'application.extensions.hanzi.HanziTools', //中文库
		'application.modules.srbac.controllers.SBaseController',
		'application.helpers.*',
		'application.extensions.phaActiveColumn.*',
		'application.extensions.bootstrap.behaviors.*',
		'application.extensions.bootstrap.helpers.*',
		'application.extensions.bootstrap.widgets.*',
	),

	'aliases' => array(
		'xupload' => 'ext.xupload',
		'bootstrap' => 'ext.bootstrap',
	),

	'modules' => array(
		// uncomment the following to enable the Gii tool
		// 'gii' => array(
		//  'class' => 'system.gii.GiiModule',
		//  'password' => '123456',
		//  // If removed, Gii defaults to localhost only. Edit carefully to taste.
		//  'ipFilters' => array('127.0.0.1', '::1'),
		//  'generatorPaths' => array('bootstrap.gii'),
		// ),
		'srbac' => array(
			'userclass' => 'Admins',
			'userid' => 'userid',
			'username' => 'username',
			'debug' => true,
			'pageSize' => 10,
			'superUser' => 'Authority',
			'css' => 'srbac.css',
			'layout' => 'application.modules.srbac.views.layouts.admin',
			'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
			'alwaysAllowed' => array('SiteLogin', 'SiteLogout', 'SiteIndex', 'SiteAdmin', 'SiteError', 'SiteContact'),
			'userActions' => array('Show', 'View', 'List'),
			'listBoxNumberOfLines' => 15,
			'imagesPath' => 'srbac.images',
			'imagesPack' => 'noia',
			'iconText' => true,
			'alwaysAllowedPath' => 'srbac.components',
		),
	),

	// application components
	'components' => array(

		// 'clientScript' => array(
		//    'class' => 'ext.minify.EClientScript',
		//    'combineScriptFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the script files
		//    'combineCssFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the css files
		//    'optimizeScriptFiles' => !YII_DEBUG, // @since: 1.1
		//    'optimizeCssFiles' => !YII_DEBUG, // @since: 1.1
		//  ),

		'image' => array(
			'class' => 'application.extensions.image.CImageComponent',
			// GD or ImageMagick
			'driver' => 'GD',
			// ImageMagick setup path
			'params' => array('directory' => '/upload/'),
		),

		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => '/public/login',
			'guestName' => 'main',
			'stateKeyPrefix' => 'zidongdenglu',
		),

		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
			'itemTable' => 'xz_items',
			'assignmentTable' => 'xz_assignments',
			'itemChildTable' => 'xz_itemchildren',
		),
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
		// 'cache' => array(
		//     'class'     => 'system.caching.CMemCache',
		//     'servers' => array(
		//      // array('host' => '192.168.0.119', 'port' => 11211),
		//      array('host' => '127.0.0.1', 'port' => 11211),
		//      ),
		// ),

		// 'session' => array (
		//     'class'=> 'CCacheHttpSession',
		//     'cacheID' => 'cache',
		//     'autoStart' => true,
		//     'timeout' => 3600,
		//     'cookieParams' => array('domain'=>'.'.$host,'lifetime' => 0),
		// ),

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			// 'urlSuffix'=>'.html', //加上.html
			'rules' => array(

				// 文章重写

				// 'http://gonglve.'.$host.'/<id:\d+>/<type:\d+>' => 'raiders/download',
				'http://www.jieshuolol.com/<pinyin:\w+>/<id:\d+>' => array('show/index', 'urlSuffix' => '.html'),

				// 'http://info.xinniangjie.com/list/<id:\d+>' => 'zixun/list',
				'http://www.jieshuolol.com/<pinyin:\w+>/page-<page:\d+>' => array('list/index', 'urlSuffix' => '/'),
				'http://www.jieshuolol.com/<pinyin:\w+>/' => array('list/index', 'urlSuffix' => '/'),

				// 'http://xiaozhi.jieshuolol.com' => 'list/2',
				'http://www.jieshuolol.com/<controller:\w+>/<id:\d+>' => '<controller>/view',
				'http://www.jieshuolol.com/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'http://www.jieshuolol.com/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),

		// 数据库设置
		'db' => array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=xiaozhi',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'xz_',
			'enableProfiling' => true,
			// 'schemaCachingDuration'=>3600*24*30,//启用表结构缓存
		),

		'errorHandler' => array(
			'errorAction' => 'site/error',
		),

		// 'log'=>array(
		//    'class'=>'CLogRouter',
		//    'routes'=>array(
		//      array(
		//        'class'=>'CFileLogRoute',
		//        'levels'=>'error, warning',
		//      ),
		//      array(
		//        'class'=>'CWebLogRoute',
		//      ),
		//    ),
		//  ),

		'mailer' => array(
			'class' => 'application.extensions.mailer.EMailer',
			'pathViews' => 'application.views.email',
			'pathLayouts' => 'application.views.email.layouts',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'tablePrefix' => 'xz_',
		'photoUrl' => 'http://img.jieshuolol.com/video_photo/',

	),
);
