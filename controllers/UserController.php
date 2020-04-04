<?php

	/**
	*
	* UserController. 
	*
	*/

	require_once 'Controller.php';
	require_once '../models/UsersModel.php';
	require_once '../requests/EditRequest.php';	

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
				$resData = ['success' => 1];
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
			$aboutUser = filter_var(trim($_POST['about']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			//К этому моменту мы точно знаем, что повтор пароля и новый пароль совпадают
			//Если в поле для пароля было что-то введено, значит пользователь хочет сменить пароль	
			if ($_POST['password']) {
				$userPassword = md5($_POST['password']);
			} else { //Иначе будем класть в базу старый пароль
				$userPassword = md5($_POST['old_password']);
			}

			$model = new UsersModel;
			//Если использовали чужой Email, то вызываем ошибку
			if ($userEmail && $userEmail != $_SESSION['userData']['email']) {
				if ($model->checkUserEmail($userEmail)) {
					$resData['success'] = 0;
					$resData['message'] = EMAIL_REPEATED;
					echo json_encode($resData);
					return;
				}
			}

			$userData = $model->updateUserData($userName, $userEmail, $userCity, $userPassword, $aboutUser);
			//Если данные успешно обновлены, то кладём их в сессию.
			if ($userData) {
				$_SESSION['userData'] = $userData;
				$resData['success'] = 1;
				echo json_encode($resData);
				return;
			}			
		}
	}