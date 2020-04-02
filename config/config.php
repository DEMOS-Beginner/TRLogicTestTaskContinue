<?php

	/**
	*
	* Главный конфигурационный файл сайта
	*
	*/


	//Константы для контроллеров
	define(CONTROLLER_PATH_PREFIX, '../controllers/'); //префикс для пути к контроллеру
	define(CONTROLLER_NAME_POSTFIX, 'Controller'); //постфикс названия контроллера
	define(ACTION_NAME_POSTFIX, 'Action'); //постфикс названия экшена

	$template = 'default'; //шаблоны - сейчас по умолчанию

	//Константы для шаблонов
	define(TEMPLATE_PATH_PREFIX, "../views/{$template}/"); //префикс для пути к шаблону
	define(TEMPLATE_PATH_POSTFIX, '.php'); //тип файлов
