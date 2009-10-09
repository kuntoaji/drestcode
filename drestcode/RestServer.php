<?php
/**
    RestServer class. Drestcode server to create REST service.
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

abstract class RestServer {
	/**
	 * RestRequest instance
	 *
	 * @access private
	 */
	private $request;

	/**
	 * RestResponse instance
	 *
	 * @access private
	 */
	private $response;

	/**
	 * Mapping hash list
	 *
	 * @var hash
	 * @access private
	 */
	private $map;

	/**
	 * Contructor. Create RestRequest and RestResponse instance
	 *
	 */
	public function __construct() {
		$this->request = new RestRequest();
		$this->response = new RestResponse();
	}

	/**
	 * Create mapping hash list
	 *
	 */
	public function setMap($method, $uri, $action) {
		$this->map[$method][$uri] = $action;
	}

	/**
	 * Get name of HTTP request method
	 *
	 */
	public function getRequestMethod() {
		return $this->request->getRequestedMethod();
	}

	/**
	 * Get name of HTTP request URI
	 *
	 */
	public function getRequestURI() {
		return $this->request->getRequestedURI();
	}

	/**
	 * Check if map true.
	 *
	 * @return name of method or action
	 * @return false
	 */
	public function isMapTrue($method,$uri) {
		$status = false;
		$maps = $this->map[$method];
		if(count($maps) > 0) {
			foreach($maps as $map=>$action) {
				if(preg_match("%^".$map."$%",$uri) ) {
					$status = $action;
				}
			}
		}
		return $status;
	}

	/**
	 * Get HTTP method data
	 *
	 * @return array
	 */
	public function getHTTPMethodData() {
		$method_data = '';
		$method_name = strtolower($this->request->getRequestedMethod());
		switch($method_name) {
			case 'get':
				$method_data = $this->request->getDataGET();
				break;
			case 'post':
				$method_data = $this->request->getDataPOST();
				break;
			case 'put':				
				$method_data = $this->request->getDataPUT();
				break;
			case 'delete':
				$method_data = $this->request->getDataDELETE();
				break;
		}

		foreach($method_data as $key => $value) {
			$result[$key] = mysql_real_escape_string($value);
		}

		return $result;
	}

	/**
	 * Set REST response header
	 *
	 * @param string $status_code
	 * @param string $content_type
	 */
	public function setRestResponse($status_code, $content_type) {
		$this->response->setResponseCode($status_code);
		$this->response->setContentType($content_type);
	}

	/**
	 * Send HTTP response body and create performance.log
	 *
	 */
	public function reply($data) {
		$this->response->sendHeader();
		echo $data;
		if(function_exists("xdebug_time_index")) {
			$filename = 'app/log/performance.log';
			$time = $this->getRequestURI()." took ".round(xdebug_time_index(),5)." seconds\n";
			$time .= "Used ".round(xdebug_memory_usage()/1024,5)."Kb of Memory\n";
			$time .= "Used at peak ".round(xdebug_peak_memory_usage()/1024,5)."Kb of Memory\n";
			if (is_writeable($filename)) {
				file_put_contents($filename, $time);
			}
		}
	}
}
?>
