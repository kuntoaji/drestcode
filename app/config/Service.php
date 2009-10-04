<?php
/**
    Service class. Define name of controller class that will be active.
    Right now, Drestcode can only run one controller at the same time.
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

class Service {
	/**
	 * Name of active controller
	 *
	 * @var string
	 * @access public static
	 */
	public static $active_controller = 'YourController';
}
?>
