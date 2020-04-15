<?php

	/**
	*
	* Базовая модель
	*
	*/

	class Model
	{

		/**
		* Соединение с базой данных
		*/
		protected $db;


		/**
		* Конструктор модели
		*/
		public function __construct()
		{
			$this->db = $GLOBALS['db'];
		}
		
	}