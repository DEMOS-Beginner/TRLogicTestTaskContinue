<?php
	
	/**
	*
	* Request для RegisterController@register
	*
	*/

	require_once 'Request.php';

	class RegisterRequest extends Request
	{

		/**
		* Проверяет регистрационные поля на корректную заполненность
		* @return array $result
		*/
		public function checkParams()
		{
			$result = [];
			extract($this->data); //Распаковываем для удобства

			if (mb_strlen($password) < 6) {
				$result['message'] = PASSWORD_MIN_LENGTH;
			}

			if ($password !== $password2) {
				$result['message'] =  PASSWORD_MISMATCH;				
			}

			if (! preg_match('/@/', $email)) {
				$result['message'] =  NOT_EMAIL;	
			}

			//Проходит по полям, если поле не заполнено, то вызывает соответствующую константу
			$this->check_fullness($result);

			//Если возникла какая-то проблема, значит не все поля корректно заполнены.
			if ($result['message']) {
				$result['success'] = 0;
				return $result;
			}

			//Если проблем не возникло, значит всё хорошо.
			$result['success'] = 1;
			return $result;
		}


	}