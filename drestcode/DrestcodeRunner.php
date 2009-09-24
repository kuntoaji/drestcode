<?php
class DrestcodeRunner {
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
