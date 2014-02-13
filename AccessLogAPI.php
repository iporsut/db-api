<?php
class AccessLogAPI {

	function setPDO($db) {
		$this->db = $db;
	}
	
	function deleteById($id) {
		$db = $this->db;
		$stmt = $db->prepare("DELETE FROM api_log WHERE id = ?");
		$stmt->execute(array($id));
		return $stmt->rowCount();
	}
	
	function insert($value_array)
	{
		$sql = "INSERT INTO api_log(ip, service_name, `datetime`, response_time,response_massage) VALUES (:ip,:service_name,:datetime,:response_time,:response_massage)";
		$q = $this->db->prepare($sql);

		return $q->execute(
			[
				$value_array['ip']=>$ip,
				$value_array['service_name']=>$service_name,
				$value_array['datetime']=>$datetime,
				$value_array['response_time']=>$response_time,
				$value_array['response_massage']=>$response_massage
			]
	    );

	}
	
	function updateById($id, $sql){
		//	try {
			//$dbh = new PDO('mysql:host=localhost;dbname='.$database, $user, $pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//try {
			$stmt = $this->db->prepare("UPDATE ".$table." SET ip=:ip where id=1");
			//$now = date("Y-m-d H:m:i");
			//$stmt->bindParam(':now', $now);
			$ip = '158.168.2.7';
					$stmt->bindParam(':ip', $ip);
	//$stmt->bindParam(':value', $value);
			$dbh->beginTransaction();
			//$dbh->exec("insert into ".$table." (ip, service_name, datetime, response_time,response_message) values('192.168.1.1', 'mysqld', '".date("Y-m-d H:m:s")."', '".date("Y-m-d H:m:s")."', 'OK')");
		//$dbh->exec("insert into salarychange (id, amount, changedate) values (23, 50000, NOW())");
			$stmt->execute();
			$dbh->commit();
		//} catch (Exception $e){
		//	echo $e->getMessage();
		//}	
	}
}
?>