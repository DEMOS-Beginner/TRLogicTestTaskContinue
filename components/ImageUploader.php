<?php

	/**
	*
	* ImageUploader. Занимается загрузкой изображений
	*
	*/

	class ImageUploader
	{

		/**
		* Загружаемое изображение
		* @var array
		*/
		protected $image;

		
		/**
		* Новое имя, сгенерированное для загруженного изображения
		* @var string
		*/
		protected $newName;

		/**
		* Конструктор класса ImageUploader
		*/
		public function __construct()
		{
			$this->image = $_FILES['image'];
		}


		/**
		* Возвращает данные о изображении
		* @return string $image
		*/
		public function checkImage()
		{
			return $this->image['name'];
		}


		/**
		* Возвращает путь, где будет лежать изображение после загрузки
		* @return string $imagePath
		*/
		public function getImagePath()
		{
			$imagePath = FILE_UPLOAD_PATH.basename($this->image['name']);

			return $imagePath;
		}


		/**
		* Возвращает расширение загружаемого файла
		* @return string $fileExt
		*/
		protected function getImageExtension()
		{
			$fileExt = explode('.', $this->image['name'])[1];

			return $fileExt;
		}

	
		/**
		* Проверяет, что расширение загружаемого файла допустимо
		* @return boolean
		*/
		protected function checkExtensions()
		{
			$fileExt = $this->getImageExtension();
			if (in_array($fileExt, FILE_EXTENSIONS)) {
				return true;
			}
			return false;
		}


		/**
		* Копирует файл на сервер, если это изображение
		* @param string $filePath
		* @return boolean
		*/
		public function copyImageToServer($filePath)
		{
			if ($this->checkExtensions()) {
				copy($this->image['tmp_name'], $filePath);
				return true;				
			}
			return false;
		}

	
		/**
		* Генерирует новое имя файла
		* @return string
		*/
		public function generateNewFileName()
		{
			$this->newName = uniqid().'.'.$this->getImageExtension();
			return $this->newName;
		}


		/**
		* Возвращает новый путь к файлу и переименовывает файл
		* @param string $filepath
		* @return string $newPath
		*/
		public function getNewPath($filePath)
		{
			$newPath = FILE_UPLOAD_PATH.$this->newName;
			rename($filePath, $newPath);
			return $newPath;
		}

	}