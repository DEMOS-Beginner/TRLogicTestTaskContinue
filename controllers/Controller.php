<?php

	/**
	*
	* Главный (базовый) контроллер, от которого все другие наследуются
	*
	*/

	//Подключение необходимых компонентов
	require_once '../config/config.php';

	class Controller
	{

		/**
		* Загружает шаблон страницы
		*
		* @param string $templateName - имя загружаемого шаблона
		* @param array $context - переменные, которые будут использоваться в шаблоне
		*/
		protected function loadTemplate($templateName, $context = array())
		{
			extract($context); //распаковывает массив на переменные
			include TEMPLATE_PATH_PREFIX.$templateName.TEMPLATE_PATH_POSTFIX;
		}

	}