<?php
/**
    RestRequest class. Class to handle request.
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

class RestRequest {
	/**
	 * Get name of request method
	 *
	 * @return HTTP method name
	 */
	public function getRequestedMethod() {
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * Get name of request URI
	 *
	 * @return name of request URI
	 */
	public function getRequestedURI() {
		return $_SERVER['REQUEST_URI'];
	}

	/**
	 * Get all HTTP POST method data
	 *
	 * @return array
	 */
	public function getDataPOST() {
		return $_POST;
	}
	
	/**
	 * Get all HTTP GET method data
	 *
	 * @return array
	 */
	public function getDataGET() {
		return $_GET;
	}
	
	/**
	 * Get all HTTP PUT method data
	 *
	 * @return array
	 */
	public function getDataPUT() {
		return $_PUT;
	}
	
	/**
	 * Get all HTTP DELETE method data
	 *
	 * @return array
	 */
	public function getDataDELETE() {
		return $_DELETE;
	}
}
?>
