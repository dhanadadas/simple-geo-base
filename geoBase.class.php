<?php

class geoBase
{
	/**
	 * geoBase constructor.
	 */
	public function __construct()
	{

		$this->sql_host = "localhost";
		$this->sql_user = "root";
		$this->sql_pass = "pass";
		$this->sql_database = "geoBase";

		$this->connect = mysqli_connect($this->sql_host, $this->sql_user, $this->sql_pass, $this->sql_database);
	}

	public function getCountry()
	{
		$country = mysqli_query($this->connect, "SELECT id,name FROM country");
		return $this->responseJson($country);
	}

	public function getRegion($country)
	{
		if (!isset($country) || !is_numeric($country) || $country <= 0) return false; // is_numeric защита от SQL иньекции.

		$regions = mysqli_query($this->connect, "SELECT id,name FROM region WHERE country_id = $country");
		return $this->responseJson($regions);
	}

	public function getCity($region)
	{
		if (!isset($region) || !is_numeric($region) || $region <= 0) return false; // is_numeric защита от SQL иньекции.

		$city = mysqli_query($this->connect, "SELECT id,name FROM city WHERE region_id = $region");
		return $this->responseJson($city);
	}

	private function responseJson($element)
	{
		if (!$element) return false;
		if ($element->num_rows !== 0) {
			while ($row = $element->fetch_array(MYSQLI_ASSOC)) {
				$result[] = $row;
			}
		} else return true;//json_encode(array('Нет регионов для этой страны'));
		return $result;// возвраащем данные в JSON формате;
	}

	function createDB()
	{
		$sql = $this->getSQL();
		if (mysqli_multi_query($this->connect, $sql)) {
			return json_encode(['status' => true, 'code' => 'Database created successfully']);
		} else {
			return json_encode(['status' => false, 'code' => 'Import error']);
		}
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