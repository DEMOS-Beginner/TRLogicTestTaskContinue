<?php

	/**
	*
	* FileUploader. Занимается загрузкой файлов
	*
	*/

	class FileUploader
	{

		/**
		* Загружаемый файл
		* @var array
		*/
		protected $file;

		
		/**
		* Новое имя, сгенерированное для загруженного файла
		* @var string
		*/
		protected $newName;

		/**
		* Конструктор класса ImageUploader
		*/
		public function __construct($fileName)
		{
			$this->file = $_FILES[$fileName];
		}


		/**
		* Возвращает имя файла
		* @return string $image
		*/
		public function checkFile()
		{
			return $this->file['name'];
		}


		/**
		* Возвращает путь, где будет лежать файл после загрузки
		* @return string $filePath
		*/
		public function getFilePath()
		{
			$filePath = FILE_UPLOAD_PATH.basename($this->file['name']);

			return $filePath;
		}


		/**
		* Возвращает расширение загружаемого файла
		* @return string $fileExt
		*/
		protected function getFileExtension()
		{
			$fileExt = end(explode('.', $this->file['name']));

			return $fileExt;
		}


		/**
		* Копирует файл на сервер, если это изображение
		* @param string $filePath
		* @return boolean
		*/
		public function copyFileToServer($filePath)
		{
			copy($this->file['tmp_name'], $filePath);
			return true;				

		}

	
		/**
		* Генерирует новое имя файла
		* @return string
		*/
		public function generateNewFileName()
		{
			$this->newName = uniqid().'.'.$this->getFileExtension();
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