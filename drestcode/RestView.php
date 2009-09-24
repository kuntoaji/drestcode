<?php
class RestView {
	private $action_view;

	public function setActionView($action) {
		$this->action_view = $action;
	}

	public function getActionView() {
		return $this->action_view;
	}

}
?>
