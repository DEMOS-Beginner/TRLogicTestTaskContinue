<?php

	/**
	*
	* Класс маршрутизатора, определяет какой контроллер и метод
	* использовать для формирования страницы 
	*
	*/

	//Подключение необходимых компонентов
	require_once '../config/config.php';

	class Router
	{

		/**
		* Имя контроллера
		*/
		private $controllerName;


		/**
		* Имя метода в контроллере
		*/
		private $actionName;


		/**
		* Конструктор маршрутизатора
		* @param string $controllerName
		* @param string $actionName
		*/
		public function __construct($controllerName, $actionName)
		{
			$this->controllerName = $controllerName.CONTROLLER_NAME_POSTFIX;
			$this->actionName = $actionName.ACTION_NAME_POSTFIX;
		}


		/**
		* Определяет контроллер и его метод
		*/
		public function run()
		{
			$controllerPath = CONTROLLER_PATH_PREFIX.$this->controllerName.'.php';

			//Подключение нужного контроллера, если такой существует
			if (file_exists($controllerPath)) {
				require_once $controllerPath;

				if (class_exists($this->controllerName)) {
					$controller = new $this->controllerName;
					$actionName = $this->actionName;
					$controller->$actionName();					
				}				
			}
					
		}


	}