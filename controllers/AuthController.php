<?php

	/**
	*
	* AuthController. Отвечает за авторизацию пользователя
	*
	*/

	//Подключение необходимых компонентов
	require_once 'Controller.php';
	require_once '../models/UsersModel.php';
	require_once '../requests/AuthRequest.php';


	class AuthController extends Controller
	{

		/**
		* Занимается формированием страницы авторизации
		*/
		public function indexAction()
		{
			if (isset($_SESSION['userData'])) {
				redirect('/user');
			}

			$this->loadTemplate('header');
			$this->loadTemplate('auth');
			$this->loadTemplate('footer');
		}


		/**
		* Авторизует пользователя
		*/
		public function authAction()
		{
			//Проверяет все поля на заполнение
			$request = new AuthRequest;
			$resData = $request->checkParams();

			//Если не все поля заполнены, то вызываем ошибку.
			if (!$resData['success']) {
				echo json_encode($resData);
				return;
			}

			//Фильтруем данные полей, хешируем пароль
			$resData = ['success' => 0, 'message' => INVALID_EMAIL_OR_PASSWORD];
			$userEmail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
			$userPassword = md5($_POST['password']);

			//Осуществляем логин
			$model = new UsersModel;
			$userData = $model->loginUser($userEmail, $userPassword);
			if ($userData) {
				$_SESSION['userData'] = $userData;
				$resData['success'] = 1;
			}
			echo json_encode($resData);
			return;
		}

	}