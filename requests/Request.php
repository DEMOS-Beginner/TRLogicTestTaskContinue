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


		/**
		* Проверяет поля на заполненность
		* @param array $result
		*/
		public function check_fullness(&$result)
		{
			//Проходит по полям, если поле не заполнено, то вызывает соответствующую константу
			foreach(array_reverse($this->data) as $key => $value) {
				if (empty($value)) {
					$result['message'] = constant('ENTER_'.strtoupper($key));
				}
			}

		}

	}