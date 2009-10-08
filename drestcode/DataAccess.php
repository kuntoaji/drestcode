<?php
/**
    DataAccess class. A database handler class.
    Copyright (C) 2009  Kunto Aji Kristianto

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

abstract class DataAccess extends Database {
	/**
	 * Connection
	 *
	 * @var string
	 * @access private
	 */
	protected $con;

	/**
	 * Results from database
	 *
	 * @var array
	 * @access private
	 */
	private $result;

	/**
	 * Constructor. Create connection to database
	 *
	 */
	public function __construct() {
		$this->con = mysql_connect($this->database_host, $this->database_user, $this->database_password);
		if(!$this->con){
			die ("Error: ". mysql_error());
		} elseif (!mysql_select_db($this->database_name, $this->con)) {
			die ("Error: ". mysql_error());
		}
	}

	/**
	 * Destructor to close connection from database.
	 *
	 */
	public function __destruct() {
		mysql_close($this->con);
	}

	/**
	 * Retrieve data from database
	 *
	 * @param string
	 * @return array
	 */
	protected function sendQuery($sql) {
		$rows = null;
		$result = mysql_query($sql, $this->con);
		if (is_array($result)) {
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$rows[$i] = $row;
				$i++;
			}
		} elseif ($result) {
			$rows = true;
		} else {
			die(mysql_error($this->con));
		}
		return $rows;
	}
}
?>
