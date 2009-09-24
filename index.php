<?php

/**
* App must have at least one controller & one model. You can have multiple view
* Controller must create instance model & view. 
* Give the name of model when creating instance. Model must return the status code.
* Give the status code when creating view instance. View must return the message.
* Controller Method (action) must return the message from view as ordered map array.
* Array must contain three key: code, data, format
* Model must have all action handler
* 
* example class name for your controller, model, & view: 
* ResourceController (mandatory)
* ResourceModel (optional)
* ResourceAction (optional)
* 
*
* Supported URI design:
* /resource/action
* /resource/action/id
* /resource/action?param=data1&param2=data2....
*/
	/** DO NOT EDIT THIS PART */
	/** start */
	$paths = array('./drestcode', './app/controllers', './app/models', './app/views', './app/config');
	foreach($paths as $path) {
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	}	

	function __autoload($class_name) {
		require_once $class_name.'.php';
	}
	DrestcodeRunner::execute();	
	restore_include_path();
	/** end */
?>
