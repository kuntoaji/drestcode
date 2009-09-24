<?php
abstract class DataAccess extends Database {
	private $con;
	private $result;
	
	public function __construct() {
		$this->con = mysqli_connect($this->database_host, $this->database_user, $this->database_password, $this->database_name);
		if(!$this->con){
			die ("Error: ". mysql_error());
		}
	}
	
	public function __destruct() {
		mysqli_close($this->con);
	}
	protected function regexQuery($param) {
		$status = null;
		if (preg_match("%^[\w\s]+$%",$param)) {
			if (preg_match("%^(.*)(UNION|union|SELECT|select|)(.*)$%",$param)) {
				$status = $param;
			}
		}
		return $status;
	}

	protected function escapeQuery($param) {
		return addslashes($param);
	}

	protected function prepareStmtQuery($statement, $data_type, $params, $rv) {
		if ($stmt = mysqli_prepare($this->con, $statement)) {
			$marker = mysqli_stmt_param_count($stmt);
			// extract parameters
			$i = 0;
			$p = array();
			foreach ($params as $param) {
				$p[$i] = $param;
				$i = $i + 1;
			}
			$row = array();
			switch ($marker) {
			case 1:
				mysqli_stmt_bind_param($stmt, $data_type, $p[0]);
				mysqli_stmt_execute($stmt); 
				break;
			case 2:
				mysqli_stmt_bind_param($stmt, $data_type, $p[0], $p[1]);
				mysqli_stmt_execute($stmt);
				break;
			case 3:
				mysqli_stmt_bind_param($stmt, $data_type, $p[0], $p[1], $p[2]);
				mysqli_stmt_execute($stmt);
				break;
			case 4:
				mysqli_stmt_bind_param($stmt, $data_type, $p[0], $p[1], $p[2], $p[3]);
				mysqli_stmt_execute($stmt);
				break;
			case 5:
				mysqli_stmt_bind_param($stmt, $data_type, $p[0], $p[1], $p[2], $p[3], $p[4]);
				mysqli_stmt_execute($stmt);
				break;
			default:
				return null;
			}
			
			switch (count($rv)) {
			case 1:
				mysqli_stmt_bind_result($stmt, $row[$rv[0]]);
				break;
			case 2:
				mysqli_stmt_bind_result($stmt, $row[$rv[0]], $row[$rv[1]]);
				break;
			case 3:
				mysqli_stmt_bind_result($stmt, $row[$rv[0]], $row[$rv[1]], $row[$rv[2]]);
				break;
			case 4:
				mysqli_stmt_bind_result($stmt, $row[$rv[0]], $row[$rv[1]], $row[$rv[2]], $row[$rv[3]]);
				break;
			case 5:
				mysqli_stmt_bind_result($stmt, $row[$rv[0]], $row[$rv[1]], $row[$rv[2]], $row[$rv[3]], $row[$rv[4]]);
				break;
			default:
				return null;
			}
			$i = 0;
			while (mysqli_stmt_fetch($stmt)) {
				foreach ($row as $key => $rslt) {
					$result[$key] = $rslt;
				}
				$rows[$i] = $result;
				$i = $i + 1;
			}
			mysqli_stmt_close($stmt);
		} 
		return $rows;
	}

	protected function sendQuery($sql) {
		$rows = null;
		$result = mysqli_query($this->con, $sql);
		if ($result) {
			$i = 0;
			while ($row = mysqli_fetch_array($result)) {
				$rows[$i] = $row;
				$i++;
			}
		} else {
			die(mysqli_error($this->con));
		}
		return $rows;
	}
}
?>
