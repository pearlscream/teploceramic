<?php
class ControllerModuleForms extends Controller {
	public function index($setting) {
		$this->load->language('module/forms');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['input_title'] = $this->language->get('input_title');

		$data['button_submit'] = $this->language->get('button_submit');


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/forms.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/forms.tpl', $data);
		} else {
			return $this->load->view('default/template/module/forms.tpl', $data);
		}
	}

	public function save() {

		$this->load->language('module/forms');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->load->model('module/forms');

			$this->model_module_forms->addData($this->request->post);

//			$json['success'] = $this->request->post;
			$json['success'] = $this->language->get('text_success');
		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}