<?php

	/**
	*
	* UserController. 
	*
	*/

	require_once 'Controller.php';

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

		
		/*
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

	}