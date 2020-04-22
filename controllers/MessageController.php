<?php

	/**
	*
	* MessageController. Отвечает за отправку сообщений от пользователя к пользователю.
	*
	*/

	//Подключение необходимых компонентов
	require_once 'Controller.php';
	require_once '../models/MessageModel.php';
	require_once '../components/FileUploader.php';

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
			$error = isset($_GET['error']) ? $_GET['error'] : null;

			$this->loadTemplate('header');
			$this->loadTemplate('messages', ['userId' => $userId, 'messages' => $messages, 'error' => $errors]);
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
			
			$text = filter_var(trim($_POST['message']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$authorId = $_POST['author_id'];
			$recipientId = $_POST['recipient_id'];
			$file = !empty($_FILES['messageFile']['name']) ? $_FILES['messageFile'] : null;

			$model = new MessageModel;
			$messageId = $model->sendMessage($text, $authorId, $recipientId);
			if ($messageId) {
				if ($file) {
					$this->uploadFile($recipientId, $messageId);
				}
				redirect("/message/{$recipientId}");
			}

		}


		/**
		* Загружает файл на сервер
		* @param int $recipientId
		* @param int $messageId
		* @return boolean $result
		*/
		public function uploadFile($recipientId, $messageId)
		{
			$fileUploader = new FileUploader('messageFile');
			$filePath = $fileUploader->getFilePath();
			$fileName = $fileUploader->checkFile();

			//Копируем фото на сервер.
			if ($fileUploader->copyFileToServer($filePath)){

				//Генерируем новое уникальное имя.
				$newName = $fileUploader->generateNewFileName();
				$newPath = $fileUploader->getNewPath($filePath);

				//Загружаем название фото в базу данных.
				$model = new MessageModel;
				if ($model->uploadFile($fileName, $newName, $messageId)) {
					redirect("/message/{$recipientId}");
				} else {
					redirect("/message/{$recipientId}?error=".UPLOAD_ERROR);
				}
			}
			redirect("/message/{$recipientId}?error=".UPLOAD_ERROR);
		}

	}