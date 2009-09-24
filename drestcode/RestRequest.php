<?php
class RestRequest {
#	private $requested_method;
#	private $get_data;
#	private $post_data;
#	private $put_data;
#	private $delete_data;
#	private $user;
#	private $passwd;
#	private $data;
#	private $requested_uri;
	
	public function getRequestedMethod() {
		return $_SERVER['REQUEST_METHOD'];
	}
	
	public function getRequestedURI() {
		return $_SERVER['REQUEST_URI'];
	}
	
	public function getDataPOST() {
		return $_POST;
	}
	
	public function getDataGET() {
		return $_GET;
	}
	
	public function getDataPUT() {
		return $_PUT;
	}
	
	public function getDataDELETE() {
		return $_DELETE;
	}
}
?>
