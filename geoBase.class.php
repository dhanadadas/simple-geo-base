<?php

class geoBase
{
	/**
	 * geoBase constructor.
	 */
	public function __construct()
	{

		// данные DB по умолчанию
		$this->sql_host = "localhost";
		$this->sql_user = "root";
		$this->sql_pass = "pass";
		$this->sql_database = "geoBase";
	}

	/**
	 * Метод getCountry выводит все страны из базы данных в формате json
	 *
	 * @param $region
	 * @return bool|false|string json ответ или false
	 */
	public function getCountry()
	{
		$this->connect();
		$country = mysqli_query($this->connect, "SELECT id,name FROM country");
		return $this->responseJson($country);
	}

	/**
	 * Метод getRegion принимает ID страны ($region) и ишет регионы прикрепленные к данной стране
	 *
	 * @param $region
	 * @return bool|false|string json ответ или false
	 */
	public function getRegion($country)
	{
		$this->connect();
		if (!isset($country) || !is_numeric($country) || $country <= 0) return false; // is_numeric защита от SQL иньекции.

		$regions = mysqli_query($this->connect, "SELECT id,name FROM region WHERE country_id = $country");
		return $this->responseJson($regions);
	}

	/**
	 * Метод getCity принимает ID регина и ишет города прикрепленные к данному региону
	 *
	 * @param $region
	 * @return bool|false|string json ответ или false
	 */
	public function getCity($region)
	{
		$this->connect();
		if (!isset($region) || !is_numeric($region) || $region <= 0) return false; // is_numeric защита от SQL иньекции.

		$city = mysqli_query($this->connect, "SELECT id,name FROM city WHERE region_id = $region");
		return $this->responseJson($city);
	}

	/**
	 * Метод responseJson принимает выборку из базы данных, проверяет и выдает JSON ответ
	 *
	 * @param $element
	 * @return false|string
	 */
	private function responseJson($element)
	{
		$this->connect();
		if (!$element) return json_encode(['status' => false, 'code' => 'Ошибка запроса']);
		if ($element->num_rows !== 0) {
			while ($row = $element->fetch_array(MYSQLI_ASSOC)) {
				$result[] = $row;
			}
		} else return json_encode(['status' => true, 'data' => false]);//json_encode(array('Нет регионов для этой страны'));
		return json_encode(['status' => true, 'data' => $result]);;// возвраащем данные в JSON формате;
	}

	/**
	 * Создание и заполнение BD
	 *
	 * Метод createDB создает структуру и загружает данные,
	 * если правильно указаны реквизиты подключения DB
	 *
	 * @return boolean true или false
	 */
	function createDB()
	{
		$this->connect();
		$sql = $this->getSQL();
		if (mysqli_multi_query($this->connect, $sql)) {
			return json_encode(['status' => true, 'code' => 'Database created successfully']);
		} else {
			return json_encode(['status' => false, 'code' => 'Import error']);
		}
	}

	/**
	 * Метод getSQL for createDB
	 *
	 * @return false|string
	 */
	private function getSQL()
	{
		return file_get_contents('./base.sql');
	}

	/**
	 * Соединение с базой данных
	 *
	 * @return bool or json (Error)
	 */
	protected function connect(){
		// проверка правильности подключения
		try {
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$this->connect = mysqli_connect($this->sql_host, $this->sql_user, $this->sql_pass, $this->sql_database);
		} catch (Exception $e) {
			echo json_encode(['status' => false, 'code' => 'Error DB']);
			exit();
		}
		$this->connect->set_charset("utf8");
		return true;
	}

	/**
	 * Метод закрытия соединения
	 */
	private function close()
	{
		return mysqli_close($this->connect);
	}

	/**
	 * Откладка внутри класса
	 *
	 * @param $var
	 */
	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	/**
	 * Destruct method
	 */
	public function __destruct()
	{
		$this->close();
	}
}
