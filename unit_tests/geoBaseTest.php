<?php

use PHPUnit\Framework\TestCase;

require '../geoBase.class.php';

/**
 * Class unit test class geoBase. Start:  phpunit geoBaseTest.php
 */
class geoBaseTest extends TestCase
{
	private $geoBase;

	protected function setUp(): void // onle > php 7.1
	{
		$this->geoBase = new geoBase();
	}

	protected function tearDown(): void
	{
		$this->geoBase = NULL;
	}

	public function testGetCityTrue() //Json
	{
		$result = $this->geoBase->getCity(rand(1,999));
		$this->assertJson($result);
	}

	public function testGetCityMinus() //False
	{
		$result = $this->geoBase->getCity(rand(-999,-1));
		$this->AssertFalse($result);
	}

	public function testGetCityString() //False
	{
		$result = $this->geoBase->getCity("null");
		$this->AssertFalse($result);
	}

	public function testGetCityNull() //False
	{
		$result = $this->geoBase->getCity(null);
		$this->AssertFalse($result);
	}

	public function testGetCityBool() //False
	{
		$result = $this->geoBase->getCity(true);
		$this->AssertFalse($result);
	}

	public function testGetCityBool2() //False
	{
		$result = $this->geoBase->getCity(false);
		$this->AssertFalse($result);
	}

	public function testGetCityZero() //False
	{
		$result = $this->geoBase->getCity(0);
		$this->AssertFalse($result);
	}

	public function testGetCitySqlInjection() //False
	{
		$result = $this->geoBase->getCity('; TRUNCATE TABLE city');
		$this->AssertFalse($result);
	}

	public function testGetRegionTrue() //Json
	{
		$result = $this->geoBase->getRegion(rand(1,999));
		$this->assertJson($result);
	}

	public function testGetRegionMinus() //False
	{
		$result = $this->geoBase->getRegion(rand(-999,-1));
		$this->AssertFalse($result);
	}

	public function testGetRegionString() //False
	{
		$result = $this->geoBase->getRegion("null");
		$this->AssertFalse($result);
	}

	public function testGetRegionNull() //False
	{
		$result = $this->geoBase->getRegion(null);
		$this->AssertFalse($result);
	}

	public function testGetRegionBool() //False
	{
		$result = $this->geoBase->getRegion(true);
		$this->AssertFalse($result);
	}

	public function testGetRegionBool2() //False
	{
		$result = $this->geoBase->getRegion(false);
		$this->AssertFalse($result);
	}

	public function testGetRegionZero() //False
	{
		$result = $this->geoBase->getRegion(0);
		$this->AssertFalse($result);
	}

	public function testGetRegionSqlInjection() //False
	{
		$result = $this->geoBase->getRegion('; TRUNCATE TABLE region');
		$this->AssertFalse($result);
	}

	public function testGetCountry() //Json
	{
		$result = $this->geoBase->getCountry();
		$this->assertJson($result);
	}
}

?>