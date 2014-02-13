<?php
	require_once 'AccessLogAPI.php';
	require_once 'MockPDO.php';
	require_once 'MockStatement.php';
	class AccessLogAPITest extends PHPUnit_Framework_TestCase {
		function setUp() {
			$this->mockPDOStatement = $this->getMock('MockStatement');
			$this->mockPDO = $this->getMock('MockPDO');
			$this->accessLogAPI = new AccessLogAPI();
		}

		function testInsertMockSuccess() {
			$this->mockPDOStatement->expects($this->exactly(1))
             ->method('execute')
             ->will($this->returnValue(true));

			$this->mockPDO->expects($this->exactly(1))
             ->method('prepare')
             ->will($this->returnValue($this->mockPDOStatement));

			$this->accessLogAPI->setPDO($this->mockPDO);
			$result = $this->accessLogAPI->insert(null);
			$this->assertTrue($result);
		}
		function testInsertMockFail() {
			$this->mockPDOStatement->expects($this->exactly(1))
             ->method('execute')
             ->will($this->returnValue(false));
            
			$this->mockPDO->expects($this->exactly(1))
             ->method('prepare')
             ->will($this->returnValue($this->mockPDOStatement));

			$this->accessLogAPI->setPDO($this->mockPDO);
			$result = $this->accessLogAPI->insert(null);
			$this->assertFalse($result);
		}
		function testDelete(){

			$this->mockPDOStatement->expects($this->once())
						  ->method('execute');

			$this->mockPDOStatement->expects($this->once())
						  ->method('rowCount')
						  ->will($this->returnValue(1));

			$this->mockPDO->expects($this->once())
				 ->method('prepare')
				 ->will($this->returnValue($this->mockPDOStatement));


			$this->accessLogAPI->setPDO($this->mockPDO);
			$result = $this->accessLogAPI->deleteById(1);

			$this->assertEquals($result, 1);
		}
	}
?>