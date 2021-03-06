<?php
	
	/**
	*
	* Request для AuthController@auth
	*
	*/

	require_once 'Request.php';

	class AuthRequest extends Request
	{

		/**
		* Проверяет поля авторизации на заполненность
		* @return array $result
		*/
		public function checkParams()
		{
			$result = [];
			extract($this->data); //Распаковываем для удобства
			$this->checkFullness($result);

			return $result;
		}


	}