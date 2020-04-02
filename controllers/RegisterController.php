<?php

	/**
	*
	* RegisterController. 
	*
	*/

	//Подключение необходимых компонентов
	require_once 'Controller.php';
	require_once '../models/UsersModel.php';

	class RegisterController extends Controller
	{

		/**
		* Занимается формированием страницы регистрации
		*/
		public function indexAction()
		{
			if (isset($_SESSION['userData'])) {
				redirect('/user');
			}

			$this->loadTemplate('header');
			$this->loadTemplate('register');
			$this->loadTemplate('footer');
		}


		/**
		* Регистрирует пользователя
		*/
		public function registerAction()
		{
			require_once '../requests/RegisterRequest.php';

			//Проверяет все поля на заполнение
			$request = new RegisterRequest;
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
			$userPassword = md5($_POST['password']);
			$aboutUser = filter_var(trim($_POST['about']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			//Если пользователь с таким Email существует, то вызываем ошибку.
			$model = new UsersModel;
			if ($model->checkUserEmail($userEmail)) {
				$resData['success'] = 0;
				$resData['message'] = 'Пользователь с таким email уже существует';
				echo json_encode($resData);
				return;
			}

			//Если пользователь успешно зарегистрирован, то кладём его данные в сессию.
			$userData = $model->registerNewUser($userName, $userEmail, $userCity, $userPassword, $aboutUser);
			if ($userData) {
				$_SESSION['userData'] = $userData;
				$resData['success'] = 1;
				echo json_encode($resData);
			}

		}


		/**
		* Загружает фото
		*/
		public function uploadAction()
		{
			$uploadFile = FILE_UPLOAD_PATH.basename($_FILES['image']['name']);

			$fileExt = explode('.', $uploadFile)[1];

			//Если это фотография, то копирем фото на сервер.
			if (in_array($fileExt, FILE_EXTENSIONS)){
				copy($_FILES['image']['tmp_name'], $uploadFile);

				//Генерируем новое уникальное имя.
				$newName = uniqid().'.'.$fileExt;
				$newPath = FILE_UPLOAD_PATH.$newName;
				rename($uploadFile, $newPath);

				//Загружаем название фото в базу данных.
				$model = new UsersModel;
				if ($model->uploadImage($newName, $_SESSION['userData']['id'])) {
					$_SESSION['userData']['image'] = $newName;
					redirect('/user');
				} else {
					echo "Ошибка при загрузке файла";
				}
			}
			echo "Файлы с таким расширением не поддерживаются";
		}

	}