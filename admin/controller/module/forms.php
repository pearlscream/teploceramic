<?php
class ControllerModuleForms extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/forms');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('forms', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = strip_tags($this->language->get('heading_title'));

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_user'] = $this->language->get('text_user');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_names'] = $this->language->get('entry_names');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['entry_form'] = $this->language->get('entry_form');
		$data['entry_user_group'] = $this->language->get('entry_user_group');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['tab_user'] = $this->language->get('tab_user');
		$data['tab_status'] = $this->language->get('tab_status');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/forms', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/forms', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['forms_status'])) {
			$data['forms_status'] = $this->request->post['forms_status'];
		} else {
			$data['forms_status'] = $this->config->get('forms_status');
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['forms'])) {
			$data['forms'] = $this->request->post['forms'];
		} else {
			$data['forms'] = $this->config->get('forms');
		}

		// >>>>>>>>>>>>> Users <<<<<<<<<<<<<<<< //
		//////////////////////////////////////////
		$this->load->model('sale/customer_group');

		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['forms_user'])) {
			$data['forms_user'] = $this->request->post['forms_user'];
		} else {
			$data['forms_user'] = $this->config->get('forms_user');
		}
		// print_r($data['forms_user']);

		//////////////////////////////////////////

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/forms.tpl', $data));
	}

	public function view(){
		$this->load->language('module/forms');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('extension/forms');

		$data['statuses'] = $this->config->get('forms');
		$data['lang'] = $this->config->get('config_language_id');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$comments = $this->model_extension_forms->editData($this->request->post);
			$status   = '<span class="label" data-status="' . $this->request->post['status'] . '" style="background: ' . $data['statuses'][$this->request->post['status']]['bg'] . '; color: ' . $data['statuses'][$this->request->post['status']]['color'] . ';">'.$data['statuses'][$this->request->post['status']]['title'][$data['lang']].'</span>';
			$comment  = '<dl class="dl-horizontal">';
			if($comments){
				foreach ($comments as $key => $value) {
					$comment .= '<dt>'.$key.'</dt><dd>'.$value.'</dd>';
				}
			}
			$comment .= '</dl>';
			$forms = array(
				'e'       => 'success',
				'status'  => $status,
				'comment' => $comment,
				);
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($forms));
		}

		$data['heading_title'] = strip_tags($this->language->get('heading_title'));

		$data['text_edit'] = $this->language->get('text_leads');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_add'] = $this->language->get('button_add');

		$data['text_form'] = $this->language->get('text_form');
		$data['text_name'] = $this->language->get('text_name');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_add'] = $this->language->get('text_add');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_comments'] = $this->language->get('text_comments');
		$data['text_actions'] = $this->language->get('text_actions');
		
		$data['text_all'] = $this->language->get('text_all');

		$data['text_no_results'] = $this->language->get('text_no_results');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->request->post['forms_status'])) {
			$data['forms_status'] = $this->request->post['forms_status'];
		} else {
			$data['forms_status'] = $this->config->get('forms_status');
		}



		$limit = array(
			'start' => 0,
			'end' => 10
			);

		$data['leads'] = $this->model_extension_forms->getData($limit);

		$data['add'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['forms_users'] = $this->config->get('forms_user');

		$data['token'] = $this->session->data['token'];
		$data['link_forms'] = $this->url->link('extension/forms', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('module/forms_view.tpl', $data);
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/forms')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "forms_data` (
			`data_id` int(11) NOT NULL AUTO_INCREMENT,
			`form_id` varchar(255) NOT NULL,
			`customer_id` int(11) NOT NULL,
			`email` varchar(255) NOT NULL,
			`name` varchar(255) NOT NULL,
			`telephone` varchar(255) NOT NULL,
			`add` text NOT NULL,
			`status_id` int(11) NOT NULL,
			`comments` text NOT NULL,
			PRIMARY KEY (`data_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "forms_data`");
	}
}