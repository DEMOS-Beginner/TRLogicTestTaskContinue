<?php

	/**
	*
	* ImageUploader. Занимается загрузкой изображений
	*
	*/

	//Подключение необходимых компонентов
	require_once 'FileUploader.php';

	class ImageUploader extends FileUploader
	{

		/**
		* Проверяет, что расширение загружаемого файла допустимо
		* @return boolean
		*/
		protected function checkExtensions()
		{
			$fileExt = $this->getFileExtension();

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
				$this->copyFileToServer($filePath);
				return true;	
			}
			return false;
		}


	}