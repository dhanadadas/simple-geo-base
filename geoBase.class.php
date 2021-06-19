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