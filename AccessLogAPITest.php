
<?php
require_once "AccessLogAPI.php";
class AccessLogAPITest extends PHPUnit_Framework_TestCase {
	
	function testInsert() {
		$accessLog = new AccessLogAPI();
		$expected = 1;
		$result = $accessLog->insert([
			'ip' => '192.168.1.100',
			'service_name' => 'somphit',
			'datetime' => '2014-02-12',
			'response_time' => '900',
			'response_massage' => 'okokokokokok'
		]);
		$this->assertEquals($expected, $result);
	}
}

?>