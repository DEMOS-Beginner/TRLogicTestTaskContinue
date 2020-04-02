<?php
	
	/**
	*
	* Базовый Request класс. Используется для валидации данных, полученных с формы.
	*
	*/



	abstract class Request
	{

		/**
		* Данные из формы
		*/
		protected $data;


		/**
		* Конструктор класса Request
		*/
		public function __construct()
		{
			$this->data = $_POST;
		}

		/**
		* Проверяет параметры, полученные с формы
		* @return array
		*/
		abstract public function checkParams();

	}