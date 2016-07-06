<?php
class ControllerModuleBlock extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/block');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->document->addScript('view/javascript/lib/codemirror.js');
		$this->document->addScript('view/javascript/lib/javascript.js');
		$this->document->addScript('view/javascript/lib/overlay.js');
		$this->document->addScript('view/javascript/lib/xml.js');
		$this->document->addScript('view/javascript/lib/css.js');
		$this->document->addScript('view/javascript/lib/htmlmixed.js');
		$this->document->addScript('view/javascript/lib/xml-fold.js');
		$this->document->addScript('view/javascript/lib/matchtags.js');
		$this->document->addScript('view/javascript/lib/emmet.min.js');
		$this->document->addStyle('view/javascript/lib/codemirror.css');
		$this->document->addStyle('view/javascript/lib/monokai.css');

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('block', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			foreach (array(0,1,2,3,4,5) as $file) {
				if(file_exists('../index-' . $file . '.html')){
					unlink ('../index-' . $file . '.html');
				}
			}


			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = strip_tags($this->language->get('heading_title'));

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_more'] = $this->language->get('text_more');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_head'] = $this->language->get('entry_head');


		$data['button_code'] = $this->language->get('button_code');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
		}

		if (isset($this->error['head'])) {
			$data['error_head'] = $this->error['head'];
		} else {
			$data['error_head'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/block', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/block', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/block', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/block', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} elseif (!empty($module_info)) {
			$data['code'] = $module_info['code'];
		} else {
			$data['code'] = '';
		}

		if (isset($this->request->post['head'])) {
			$data['head'] = $this->request->post['head'];
		} elseif (!empty($module_info)) {
			$data['head'] = $module_info['head'];
		} else {
			$data['head'] = '';
		}

		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['fields'])) {
			$data['fields'] = $this->request->post['fields'];
		} elseif (!empty($module_info)) {
			$data['fields'] = $module_info['fields'];
		} else {
			$data['fields'] = '';
		}
// print_r($data['fields']);
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/block.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/block')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (utf8_strlen($this->request->post['code']) < 3) {
			$this->error['code'] = $this->language->get('error_code');
		}

		return !$this->error;
	}
}