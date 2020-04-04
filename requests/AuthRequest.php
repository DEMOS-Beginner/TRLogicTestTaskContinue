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

			$this->check_fullness($result);

			//Если возникла какая-то проблема, значит не все данные заполнены.
			if ($result['message']) {
				$result['success'] = 0;
				return $result;
			}
			
			//Если проблем не возникло, значит всё хорошо.
			$result['success'] = 1;
			return $result;
		}


	}