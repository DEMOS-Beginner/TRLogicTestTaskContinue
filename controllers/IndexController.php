<?php

	/**
	*
	* IndexController. 
	*
	*/

	require_once 'Controller.php';

	class IndexController extends Controller
	{

		/**
		* Занимается формированием главной страницы
		*/
		public function indexAction()
		{
			$this->loadTemplate('header');
			$this->loadTemplate('index');
			$this->loadTemplate('footer');
		}


		/**
		* Создаёт сессионную переменную с указанным языком
		*/
		public function setlangAction()
		{
			$_SESSION['lang'] = $_POST['lang'];
			$resData['success'] = 1;
			echo json_encode($resData);
			return;
		}

	}