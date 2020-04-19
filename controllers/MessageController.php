<?php

	/**
	*
	* MessageController. Отвечает за отправку сообщений от пользователя к пользователю.
	*
	*/

	//Подключение необходимых компонентов
	require_once 'Controller.php';
	require_once '../models/MessageModel.php';

	class MessageController extends Controller
	{
		/**
		* Занимается формированием страницы переписки
		*/
		public function indexAction()
		{
			if (!isset($_SESSION['userData'])) {
				redirect('/auth');
			}

			$userId = isset($_GET['id']) ? intval($_GET['id']) : null;
			if (empty($userId) || !is_int($userId)) {
				redirect('/');
			}

			$model = new MessageModel;
			$messages = $model->getMessages($_SESSION['userData']['id'], $userId);

			$this->loadTemplate('header');
			$this->loadTemplate('messages', ['userId' => $userId, 'messages' => $messages]);
			$this->loadTemplate('footer');
		}


		/**
		* Кладёт сообщение в базу данных
		*/
		public function sendAction()
		{
			if (!isset($_SESSION['userData'])) {
				redirect('/auth');
			}
			d($_FILES);
			$text = filter_var(trim($_POST['message']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$authorId = $_POST['author_id'];
			$recipientId = $_POST['recipient_id'];	

			$model = new MessageModel;

			if ($model->sendMessage($text, $authorId, $recipientId)) {
				redirect($_SERVER['QUERY_STRING']);
			}

		}

	}