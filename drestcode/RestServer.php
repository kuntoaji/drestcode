<?php
abstract class RestServer {
	private $request;
	private $response;
	private $map;

	public function __construct() {
		$this->request = new RestRequest();
		$this->response = new RestResponse();
	}

	public function setMap($method, $uri, $action) {
		$this->map[$method][$uri] = $action;
	}

	public function getRequestMethod() {
		return $this->request->getRequestedMethod();
	}

	public function getRequestURI() {
		return $this->request->getRequestedURI();
	}
	
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
		return $method_data;
	}

	public function setRestResponse($status_code, $content_type) {
		$this->response->setResponseCode($status_code);
		$this->response->setContentType($content_type);
	}

	public function reply($data) {
		$this->response->sendHeader();
		echo $data;
		$filename = 'app/log/performance.log';
		if(function_exists("xdebug_time_index")) {
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
