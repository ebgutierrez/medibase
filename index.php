<?php
	ini_set('display_errors', 1);
	 ini_set('log_errors', 1);
	 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
	 error_reporting(E_ALL);
	/**
	 * WEB_ROOT_FOLDER is the name of the parent folder you created these 
	 * documents in.
	 */
	if(!defined('SERVER_ROOT'))
		define('SERVER_ROOT' , '/jca');

   
	//set system path
	if(!defined('SYSTEM_PATH'))
		define('SYSTEM_PATH','framework');


	//check if system path is not deleted
	if(!is_dir(SYSTEM_PATH))
		die('System path invalid');


	//load system configurations
	require_once SYSTEM_PATH . '/config/config.php';

	//load core class
	require_once $_SERVER['framework'] . '/core/Core.php';

	//load URI class
	require_once $_SERVER['lib'] . '/URI/URI.php';

	

	$URI = new URI;
	$URI->URISegments = $URI->selfURL();
	

	//load router
	require_once $_SERVER['lib'] . '/router/Router.php';
	//load Loader
	require_once $_SERVER['lib'] . '/loader/Loader.php';

	
	$RTR = new Router;
	$RTR->segments = $URI->parseURISegment();
	
	$RTR->mapController();
	
?>