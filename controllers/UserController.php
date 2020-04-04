<?php

	/**
	*
	* UserController. 
	*
	*/

	require_once 'Controller.php';
	require_once '../models/UsersModel.php';

	class UserController extends Controller
	{

		/**
		* Занимается формированием страницы авторизации
		*/
		public function indexAction()
		{
			//Доступ только для авторизованных пользователей
			if (!isset($_SESSION['userData'])) {
				redirect('/');
			}

			$this->loadTemplate('header');
			$this->loadTemplate('user');
			$this->loadTemplate('footer');
		}

		
		/**
		* Удаляет сессию пользователя, таким образом осуществляет выход из аккаунта
		*/
		public function logoutAction()
		{
			if (isset($_SESSION['userData'])) {
				unset($_SESSION['userData']);
				$resData['success'] = 1;
				echo json_encode($resData);
				return;
			}
		}


		/**
		* Формирует страницу редактирования профиля
		*/
		public function editpageAction()
		{
			//Доступ только для авторизованных пользователей
			if (!isset($_SESSION['userData'])) {
				redirect('/');
			}

			$this->loadTemplate('header');
			$this->loadTemplate('edit');
			$this->loadTemplate('footer');
		}

		/**
		* Редактирует данные пользователя
		*/
		public function editAction()
		{
			require_once '../requests/EditRequest.php';

			$request = new EditRequest;
			$resData = $request->checkParams();

			//Если не все поля заполнены, то вызываем ошибку.
			if (!$resData['success']) {
				echo json_encode($resData);
				return;
			}

			//Фильтруем данные, полученные с полей. Хешируем пароль.
			$resData = [];
			$userName = filter_var(trim($_POST['name']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$userEmail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
			$userCity = filter_var(trim($_POST['city']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			//К этому моменту мы точно знаем, что повтор пароля и новый пароль совпадают		
			if ($_POST['password']) {
				$userPassword = md5($_POST['password']);
			} else {
				$userPassword = md5($_POST['old_password']);
			}
			$aboutUser = filter_var(trim($_POST['about']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			//Если пользователь с таким Email существует, то вызываем ошибку.
			$model = new UsersModel;
			if ($userEmail && $userEmail != $_SESSION['userData']['email']) {
				if ($model->checkUserEmail($userEmail)) {
					$resData['success'] = 0;
					$resData['message'] =  USER_EMAIL_REPEATED;
					echo json_encode($resData);
					return;
				}
			}

			//Если пользователь успешно зарегистрирован, то кладём его данные в сессию.
			$userData = $model->updateUserData($userName, $userEmail, $userCity, $userPassword, $aboutUser);
			if ($userData) {
				$_SESSION['userData'] = $userData;
				$resData['success'] = 1;
				echo json_encode($resData);
			}			
		}
	}