<?php 

	/*
	*
	* Инициализация подключения к базе данных
	*
	*/

	$dblocation = '127.0.0.1'; //ip базы данных
	$dbname = 'test_trlogic'; //название базы
	$dbuser = 'root'; //имя пользователя
	$dbpassword = ''; //пароль пользователя
	$hostName = 'trlogic'; //имя хоста

	//Установка соединения
	try {
		$db = new PDO("mysql:host=$hostName;dbname=$dbname", $dbuser, $dbpassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	} catch (PDOException $e) {
		echo "Невозможно установить соединение с базой данных <br>";
	}

