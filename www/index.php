<?php

	/**
	*
	* Главный файл сайта (можно назвать FRONT CONTROLLER)
	*
	*/
	session_start();

	//По умолчанию стоит русский язык
	if (!isset($_SESSION['lang'])) {
		$_SESSION['lang'] = 'ru';
	}

	//Подключение необходимых компонентов
	require_once '../components/Router.php';
	require_once '../config/db.php';
	require_once '../config/config.php';
	require_once "../config/lang/{$_SESSION['lang']}.php";
	require_once '../library/mainFunctions.php';

	//К этому моменту строка типа 'index/index' уже преобразована с помощью .htaccess
	//Получаем имя контроллера и определяем его метод.
	$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
	$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

	//Передаем имя контроллера и экшена роутеру
	$router = new Router($controllerName, $actionName);
	$router->run();
