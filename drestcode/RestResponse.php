<?php
/**
    RestResponse class. Class to handle response.
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

class RestResponse {
	/**
	 * Format data
	 *
	 * @var string
	 * @access private
	 */
	private $data_format;

	/**
	 * HTTP status code that will be used as response
	 *
	 * @var string
	 * @access private
	 */
	private $response_code;

	/**
	 * Hash List of HTTP status code and HTTP status message
	 *
	 * @var hash
	 * @access private
	 */
	private $response_code_message;

	/**
	 * Constructor. Define HTTP status code and HTTP status message
	 *
	 */
	public function __construct() {
		$this->response_code_message = Array(
				'100' => 'Continue', 
       				'101' => 'Switching Protocols',
       				'102' => 'Processing',
       				'200' => 'OK',
				'201' => 'Created',
  				'202' => 'Accepted',
  				'203' => 'Non-Authoritative Information',
  				'204' => 'No Content',
  				'205' => 'Reset Content',
  				'206' => 'Partial Content',
  				'207' => 'Multi-Status',
  				'300' => 'Moved Permanently',
  				'302' => 'Found',
  				'303' => 'See Other',
  				'304' => 'Not Modified',
  				'305' => 'Use Proxy',
  				'306' => 'Switch Proxy',
  				'307' => 'Temporary Redirect',
  				'400' => 'Bad Request',
  				'401' => 'Unauthorized',
  				'402' => 'Payment Required',
  				'403' => 'Forbidden',
  				'404' => 'Not Found',
  				'405' => 'Method Not Allowed',
  				'406' => 'Not Acceptable',
  				'407' => 'Proxy Authentication Required',
  				'408' => 'Request Timeout',
  				'409' => 'Conflict',
  				'410' => 'Gone',
  				'411' => 'Length Required',
  				'412' => 'Precondition Failed',
  				'413' => 'Request Entity Too Large',
  				'414' => 'Request-URI Too Long',
  				'415' => 'Unsupported Media Type',
  				'416' => 'Requested Range Not Satisfiable',
  				'417' => 'Expectation Failed',
  				'418' => 'I\'m a teapot',
  				'422' => 'Unprocessable Entity',
  				'423' => 'Locked',
  				'424' => 'Failed Dependency',
  				'425' => 'Unordered Collection',
  				'426' => 'Upgrade Required',
  				'449' => 'Retry With',
  				'500' => 'Internal Server Error',
  				'501' => 'Not Implemented',
 				'502' => 'Bad Gateway',
	 			'503' => 'Service Unavailable',
  				'504' => 'Gateway Timeout',
  				'505' => 'HTTP Version Not Supported',
  				'506' => 'Variant Also Negotiates',
  				'507' => 'Insufficient Storage',
  				'509' => 'Bandwidth Limit Exceeded',
  				'510' => 'Not Extended'
		      );	
	}	

	/**
	 * Set HTTP status code
	 *
	 * @return string
	 */
	public function setResponseCode($response_code = '404') {
		$this->response_code = $response_code;
	}

	/**
	 * Set Content Type (MIME)
	 *
	 * @return string
	 */
	public function setContentType($format = 'application/xml') {
		$this->data_format = $format;
	}

	/**
	 * Send HTTP response header
	 *
	 */
	public function sendHeader() {
		
		$header_message = $_SERVER['SERVER_PROTOCOL'].' '.$this->response_code.' '.$this->response_code_message[$this->response_code];
		$header_content_type = 'Content-Type: '.$this->data_format;
		header($header_message);
		header($header_content_type);
	}
}
?>
