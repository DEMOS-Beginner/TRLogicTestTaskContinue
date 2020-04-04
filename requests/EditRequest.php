<?php
	
	/**
	*
	* Request для UserController@edit
	*
	*/

	require_once 'Request.php';

	class EditRequest extends Request
	{

		/**
		* Проверяет регистрационные поля на корректную заполненность
		*/
		public function checkParams()
		{
			$result = [];
			extract($this->data); //Распаковываем для удобства

			//Если что-то введено в пароль, значит пользователь хочет сменить пароль
			if ($password) {

				if (mb_strlen($password) < 6) {
					$result['message'] = PASSWORD_MIN_LENGTH;
				}

				if ($password !== $password2) {
					$result['message'] = PASSWORD_MISMATCH;				
				}

				if (!$password2) {
					$result['message'] = ENTER_PASSWORD2;	
				}
			}

			if (md5($old_password) != $_SESSION['userData']['password']) {
				$result['message'] = INVALID_PASSWORD;
			}

			if (! preg_match('/@/', $email)) {
				$result['message'] =  NOT_EMAIL;	
			}

			//Проходит по полям, если поле не заполнено, то вызывает соответствующую константу
			foreach(array_reverse($this->data) as $key => $value) {
				if (!$value && !in_array($key, ['password', 'password2']) ) {
					$result['message'] = constant('ENTER_'.strtoupper($key));
				}
			}

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