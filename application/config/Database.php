<?php

	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	/*
		+---------------------------------------------------------------+
		|					DATABASE CONFIG								|
		+---------------------------------------------------------------+
		|	1. db_driver = mysql,mssql,oracle,sqli,sqlite,mysqli		|
		|	2. db_host = database host of the server					|
		|	3. db_name = database name									|
		|	4. db_username = username of the database					|
		|	5. db_password = password of the database					|
		+---------------------------------------------------------------+
	*/

	$db_config['db_driver'] = 'mysql'; //for all
	
	//$db_config['db_host'] = 'druidinnovationscom.ipagemysql.com'; //for ipage
	$db_config['db_host'] = 'localhost'; //for local and justhost
	

	//$db_config['db_name'] = 'jca_2013'; //for local and ipage
	$db_config['db_name'] = 'druidinc_jcadev2013'; //for justhost
	
	//$db_config['db_username'] = 'root'; //for local
	$db_config['db_username'] = 'druidinc_jca2013'; // for justhost
	//$db_config['db_username'] = 'jcadb2013'; //for ipage
	
	//$db_config['db_password'] = '123456'; //for ipage and local
	$db_config['db_password'] = 'jca2013!!';//for justhost
?>