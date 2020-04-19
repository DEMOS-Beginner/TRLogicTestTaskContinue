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
			$author_messages = $this->getAuthorMessages($authorId, $recipientId);
			$recipient_messages = $this->getRecipientMessages($authorId, $recipientId);

			$messages = array_merge($author_messages, $recipient_messages);

			return $messages;

		}


		/**
		* Возвращает сообщения автора
		* @param int $authorId
		* @param int $recipientId
		* @return array messages
		*/
		public function getAuthorMessages($authorId, $recipientId)
		{
			$sql = 'SELECT m.*, `u`.name AS author_name, `u`.id AS author_id, `u`.image AS author_image
					FROM messages AS m
					INNER JOIN users AS u  ON `u`.id = :author_id
					WHERE (`m`.author_id = :author_id AND `m`.recipient_id = :recipient_id)
					ORDER BY `m`.created_at DESC';			

			$query = $this->db->prepare($sql);
			$query->execute(['author_id' => $authorId, 'recipient_id' => $recipientId]);
			$messages = $query->fetchAll(PDO::FETCH_ASSOC);

			return $messages;
		}


		/**
		* Возвращает сообщения получателя
		* @param int $authorId
		* @param int $recipientId
		* @return array messages
		*/
		public function getRecipientMessages($authorId, $recipientId)
		{
			$sql = 'SELECT m.*, `u`.name AS author_name, `u`.id AS author_id, `u`.image AS author_image
					FROM messages AS m
					INNER JOIN users AS u  ON `u`.id = :recipient_id
					WHERE (`m`.author_id = :recipient_id AND `m`.recipient_id = :author_id)
					ORDER BY `m`.created_at DESC';			

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