<?php
	
	int_set('display_errors',1);
	int_set('display_startup_errors',1);
	error_reporting(E_ALL);

	if (!isset($_SESSION))
	{
		session_start();
		$_SESSION['token'] = md5(uniqid(mt_rand(),true));
	}

	if (!isset($_SESSION['token']))
	{
		session_start();
		$_SESSION['token'] = md5(uniqid(mt_rand(),true));
	}

	if (!isset($_SESSION['token']))
	{
		session_start();
		define("BASE_¨PATH", "http://localhost:8888/programacion_web/");
	}



}