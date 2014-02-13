<?php
	require_once 'AccessLogAPI.php';
	require_once 'MockPDO.php';
	require_once 'MockStatement.php';
	class AccessLogAPITest extends PHPUnit_Framework_TestCase {
		function setUp() {
			$this->mockPDOStatement = $this->getMock('PDOStatement');
			$this->mockPDO = $this->getMock('MockPDO');
			$this->object = new AccessLogAPI();
		}
		function testInsert() {
			$object = new AccessLogAPI();
			$dbh = new PDO('mysql:host=localhost;dbname=access_log', 'root', '1234');
			$object->setPDO($dbh);
			$result = $object->insert(null);
			$this->assertTrue($result);
		}

		function testInsertMockSuccess() {
			$this->mockPDOStatement->expects($this->exactly(1))
             ->method('execute')
             ->will($this->returnValue(true));

			$this->mockPDO->expects($this->exactly(1))
             ->method('prepare')
             ->will($this->returnValue($this->mockPDOStatement));

			$this->object->setPDO($this->mockPDO);
			$result = $this->object->insert(null);
			$this->assertTrue($result);
		}
		function testInsertMockFail() {
			$this->mockPDOStatement->expects($this->exactly(1))
             ->method('execute')
             ->will($this->returnValue(false));
            
			$this->mockPDO->expects($this->exactly(1))
             ->method('prepare')
             ->will($this->returnValue($this->mockPDOStatement));

			$this->object->setPDO($this->mockPDO);
			$result = $this->object->insert(null);
			$this->assertFalse($result);
		}		
	}
?>