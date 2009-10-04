<?php
/**
    Database abstract class. Database configuration file.
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

abstract class Database {
	/**
	 * Database Configuration
	 *
	 * @var string $database_host, $database_name, $database_user, $database_password
	 * @access protected $database_host, $database_name, $database_user, $database_password
	 */
	protected $database_host = 'localhost';
	protected $database_name = 'db_name';
	protected $database_user = 'root';
	protected $database_password = '';
}
?>
