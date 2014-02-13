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
		return 1;
	}
	

	function insert($value_array) {
		$sql = "INSERT INTO api_log(ip, service_name, `datetime`, response_time,response_massage) VALUES (:ip,:service_name,:datetime,:response_time,:response_massage)";
		$q = $this->db->prepare($sql);

		return $q->execute(
			[
				':ip'=>$value_array['ip'],
				':service_name'=>$value_array['service_name'],
				':datetime'=>$value_array['datetime'],
				':response_time'=>$value_array['response_time'],
				':response_massage'=>$value_array['response_massage']
			]
	    );
	}
	
	function updateById($id, $sql) {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $this->db->prepare("UPDATE ".$table." SET ip=:ip where id=1");		
		$ip = '158.168.2.7';
		$stmt->bindParam(':ip', $ip);
		$dbh->beginTransaction();	
		$stmt->execute();
		$dbh->commit();
	}

}
?>