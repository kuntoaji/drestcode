<?php
/**
    DrestcodeRunner. Execute Drestcode.
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

class DrestcodeRunner {
	/**
	 * Framework runner, create object from User Application Controller
	 *
	 * Instance call init() and isMapTrue(). If isMapTrue is True, it will return method name.
	 */
	public static function execute() { 
		$class_controller = Service::$active_controller;

		if ($class = new ReflectionClass($class_controller)) {
			$object = $class->newInstance();
			$object->init();
			$request_method = $object->getRequestMethod();
			$request_uri = $object->getRequestURI();

			if($action = $object->isMapTrue($request_method, $request_uri)) {
				$data = $class->getMethod($action)->invoke($object);
				$object->reply($data);
			} else {
				$object->setRestResponse('406', 'application/xml');
				$data = "<application>\n";
				$data .= "<error>Not Acceptible. Action Method Not Found</error>\n";
				$data .= "</application>\n";
				$object->reply($data);
			}
		} else {
			$object->setRestResponse('400', 'application/xml');
			$data = "<application>\n";
			$data .= "<error>Bad Request</error>\n";
			$data .= "</application>\n";
			$object->reply($data);
		}
	}
}
?>
