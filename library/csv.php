<?php
/**
 * Класс для работы с csv-файлами
 */
class CSV {
	private $_csv_file = null;
	/**
	 * @param string $csv_file  - путь до csv-файла
	 */
	public function __construct($csv_file) {
		if (file_exists($csv_file)) { //Если файл существует
			$this->_csv_file = $csv_file; //Записываем путь к файлу в переменную
		}
		else throw new Exception("Файл \"$csv_file\" не найден"); //Если файл не найден то вызываем исключение
	}
	public function setCSV(Array $csv) {
		$handle = fopen($this->_csv_file, "a"); //Открываем csv для до-записи, если указать w, то  ифномация которая была в csv будет затерта
		foreach ($csv as $value) { //Проходим массив
			fputcsv($handle, explode(";", $value), ";"); //Записываем, 3-ий параметр - разделитель поля
		}
		fclose($handle); //Закрываем
	}
	/**
	 * Метод для чтения из csv-файла. Возвращает массив с данными из csv
	 * @return array;
	 */
	public function getCSV() {
		$handle = fopen($this->_csv_file, "r"); //Открываем csv для чтения
		$array_line_full = array(); //Массив будет хранить данные из csv
		while (($line = fgetcsv($handle, 0, ";")) !== FALSE) { //Проходим весь csv-файл, и читаем построчно. 3-ий параметр разделитель поля
			$array_line_full[] = $line; //Записываем строчки в массив
		}
		fclose($handle); //Закрываем файл
		return $array_line_full; //Возвращаем прочтенные данные
	}
}
