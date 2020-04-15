<?php

	/**
	*
	* Модель для работы с таблицей сообщений
	*
	*/

	//Подключение необходимых компонентов
	require_once 'Model.php';

	class MessageModel extends Model
	{

		/**
		* Возвращает сообщения пользователей 
		* @param int $authorId
		* @param int $recipientId
		* @return array messages
		*/
		public function getMessages($authorId, $recipientId)
		{
			$sql = 'SELECT m.*, `u`.image AS user_image FROM messages AS m JOIN users AS u ON `u`.id = :author_id WHERE `m`.author_id = :author_id AND `m`.recipient_id = :recipient_id ORDER BY `m`.created_at DESC';
			$query = $this->db->prepare($sql);
			$query->execute(['author_id' => $authorId, 'recipient_id' => $recipientId]);
			$messages = $query->fetchAll(PDO::FETCH_ASSOC);

			return $messages;
		}


		/**
		* Сохраняет сообщение пользователя в бд
		* @param string $text
		* @param int $authorId
		* @param int $recipientId
		* @return bool $result
		*/
		public function sendMessage($text, $authorId, $recipientId)
		{
			$sql = 'INSERT INTO messages (`text`, author_id, recipient_id) VALUES (:txt, :author, :recipient)';
			$query = $this->db->prepare($sql);
			$result = $query->execute(["txt" => $text, "author" => $authorId, "recipient" => $recipientId]);

			return $result;
		}

	}