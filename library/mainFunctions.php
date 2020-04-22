<?php 

	/**
	*
	* Файл с основными функциями
	*
	*/

	/**
	* Функция-помощник для нахождения ошибок
	* @param $value - значение, которое необходимо вывести
	* @param int $die - продолжать работу программы после вызова или нет
	*/
	function d($value = null, $die = 1)
	{

		function debugOut($a) {
			echo "<br><b>".basename($a['file'])."</b>"
				."&nbsp;<font color = 'red'> ({$a['line']}) </font>"
				."&nbsp;<font color = 'green'> {$a['function']}() </font>"
				."&nbsp; -- ". dirname($a['file']);
		}

		echo "<pre style='background: #01001c; color: white; padding: 5px;'>";
			$trace = debug_backtrace();
			array_walk($trace, 'debugOut');
			echo "\n\n";
			print_r($value);
		echo "</pre>";

		if ($die) die;

	}
	

	/**
	* Возвращает отсортированный по полю массив массивов
	* @param array $array
	* @param string $fieldName
	* @return array $sorted
	*/
	function sortArraysByIntField($arrays, $fieldName)
	{
		$values = [];
		foreach($arrays as $array) {
			$values[] = $array[$fieldName];
		}
		arsort($values);
		$sorted = [];

		foreach($values as $value) {
			foreach($arrays as $array) {
				if ($array['id'] === $value) {
					$sorted[] = $array;
				}
			}
		}	

		return $sorted;
	}


	/**
	* Перенаправляет на страницу с введёнными url
	* @param string $url - URL
	* @param array $errors - возможные ошибки
	*/

	function redirect($url)
	{
		if (!$url) $url = '/';
		header("Location: $url");
		exit;

	}



?>