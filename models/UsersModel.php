<?php

	/**
	*
	* Модель для обращения к таблице пользователей
	*
	*/

	class UsersModel
	{

		/**
		* Соединение с базой данных
		*/
		protected $db;


		/**
		* Конструктор модели
		*/
		public function __construct()
		{
			$this->db = $GLOBALS['db'];
		}


		/**
		* Проверяет не зарегистрирован ли уже пользователь с таким email
		* @param string $email
		* @return int
		*/
		public function checkUserEmail($email)
		{ 
			//Получаем id пользователя с таким email
			$sql = 'SELECT id FROM users WHERE email = :email';
			$query = $this->db->prepare($sql);
			$query->execute(['email' => $email]);

			$result = $query->fetch();

			return $result;
		}


		/**
		* Заносит данные пользователя в базу данных
		* @param string $userName
		* @param string $userEmail
		* @param string $userPassword
		* @return array $userData
		*/
		public function registerNewUser($userName, $userEmail, $userCity, $userPassword, $aboutUser)
		{
			//Вставляем данные пользователя в таблицу пользователей
			$sql = 'INSERT INTO users (name, email, city, password, about) VALUES (:name, :email, :city, :password, :about)';
			$query = $this->db->prepare($sql);
			$result = $query->execute([
				'name'     => $userName,
				'email'    => $userEmail,
				'city'     => $userCity,
				'password' => $userPassword,
				'about'    => $aboutUser,
			]);

			//Если пользователь успешно зарегистрировался, то сразу логиним его
			if ($result) {
				$userData = $this->loginUser($userEmail, $userPassword);
				return $userData;
			} 

			return $result;
		}


		/**
		* Находит в базе данных пользователя с указанным паролем и email
		* @param string $email
		* @param string $password
		* @return array $userData
		*/
		public function loginUser($email, $password)
		{
			$sql = 'SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1';
			$query = $this->db->prepare($sql);
			$query->execute([
				'email'    => $email,
				'password' => $password,
			]);
			$userData = $query->fetch();

			return $userData;
		}


		/**
		* Загружает название фото в базу данных
		* @param string $filename
		* @param int $userId
		* @return boolean
		*/
		public function uploadImage($filename, $userId)
		{
			$sql = 'UPDATE users SET image = :image WHERE id = :id';
			$query = $this->db->prepare($sql);
			$result = $query->execute([
				'image'    => $filename,
				'id' => $userId,
			]);

			return $result;
		}


		/**
		* Обновляет данные пользователя в базе данных
		* @param string $userName
		* @param string $userEmail
		* @param string $userPassword
		* @return array $userData
		*/
		public function updateUserData($userName, $userEmail, $userCity, $userPassword, $aboutUser)
		{
			//Обновляем данные пользователя
			$sql = 'UPDATE users SET name = :name, email = :email, city = :city, password = :password, about = :about WHERE id = :id';
			$query = $this->db->prepare($sql);
			$result = $query->execute([
				'name'     => $userName,
				'email'    => $userEmail,
				'city'     => $userCity,
				'password' => $userPassword,
				'about'    => $aboutUser,
				'id'       => $_SESSION['userData']['id'],
			]);

			//Если пользователь успешно зарегистрировался, то сразу логиним его
			if ($result) {
				$userData = $this->loginUser($userEmail, $userPassword);
				return $userData;
			} 

			return $result;
		}

		/**
		* Возвращает данные обо всех пользователях
		* @return array $users
		*/
		public function getAllUsers()
		{
			$sql = 'SELECT id, name, city, about, email, image FROM users';
			$query = $this->db->prepare($sql);
			$query->execute();
			$users = $query->fetchAll(PDO::FETCH_ASSOC);

			return $users;
		}


		/**
		* Возвращает данные пользователя c указанным id
		* @param int $id
		* @return array $userData
		*/
		public function getUserById($id)
		{
			$sql = 'SELECT * FROM users WHERE id = :id';
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			$userData = $query->fetch(PDO::FETCH_ASSOC);

			return $userData;			
		}

	}