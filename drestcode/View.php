<?php
/**
    View class. Class to get what view will be used.
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


class View {
	/**
	 * Name of view that will be used.
	 *
	 * @var string
	 * @access private
	 */
	private $action_view;

	/**
	 * Set the name of view
	 *
	 * @param string
	 */
	public function setActionView($action) {
		$this->action_view = $action;
	}

	/**
	 * Get the name of view
	 *
	 * @return string
	 */
	public function getActionView() {
		return $this->action_view;
	}
}
?>
