<?php
class ControllerModuleVisitors extends Controller {
	public function index() {

		$this->load->model('module/visitors');
// echo 1;
		$this->model_module_visitors->addVisitor();
		return '';
	}
}