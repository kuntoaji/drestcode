<?php
/**
    Drestcode Index File. Purpose: Load all php file which is needed and run DrestcodeRunner.
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

	/**
	 * Load all path
	 *
	 */
	$paths = array('./drestcode', './app/controllers', './app/models', './app/views', './app/config');
	foreach($paths as $path) {
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	}	

	/**
	 * Calling php file
	 *
	 * @param string
	 *
	 */ 
	function __autoload($class_name) {
		require_once $class_name.'.php';
	}

	/**
	 * Run DrestcodeRunner
	 *
	 */
	DrestcodeRunner::execute();

	/**
	 * Restoring path to default
	 *
	 */	
	restore_include_path();
?>
