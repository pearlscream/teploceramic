<?php
class ControllerModuleVisitors extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/visitors');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('visitors', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = strip_tags($this->language->get('heading_title'));

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'href' => $this->url->link('module/visitors', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/visitors', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['visitors_status'])) {
			$data['visitors_status'] = $this->request->post['visitors_status'];
		} else {
			$data['visitors_status'] = $this->config->get('visitors_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/visitors.tpl', $data));
	}

	public function view() {
		$this->load->language('module/visitors');

		$data['heading_title'] = strip_tags($this->language->get('heading_title'));

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('extension/visitors');

		// Customers Online
		$total_visitors = $this->model_extension_visitors->getTotalVisitors();
		$total_views = $this->model_extension_visitors->getTotalViews();

		if ($total_visitors > 1000000000000) {
			$data['total'] = round($total_visitors / 1000000000000, 1) . 'T';
		} elseif ($total_visitors > 1000000000) {
			$data['total'] = round($total_visitors / 1000000000, 1) . 'B';
		} elseif ($total_visitors > 1000000) {
			$data['total'] = round($total_visitors / 1000000, 1) . 'M';
		} elseif ($total_visitors > 1000) {
			$data['total'] = round($total_visitors / 1000, 1) . 'K';
		} else {
			$data['total'] = $total_visitors;
		}
		if ($total_views > 1000000000000) {
			$data['total_views'] = round($total_views / 1000000000000, 1) . 'T';
		} elseif ($total_views > 1000000000) {
			$data['total_views'] = round($total_views / 1000000000, 1) . 'B';
		} elseif ($total_views > 1000000) {
			$data['total_views'] = round($total_views / 1000000, 1) . 'M';
		} elseif ($total_views > 1000) {
			$data['total_views'] = round($total_views / 1000, 1) . 'K';
		} else {
			$data['total_views'] = $total_views;
		}

		$data['online'] = 'https://www.google.com/analytics/web/';

		return $this->load->view('module/visitors_d.tpl', $data);
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/visitors')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "visitors` (
			`visitor_id` int(11) NOT NULL AUTO_INCREMENT,
			`ip` varchar(255) NOT NULL,
			`date` varchar(255) NOT NULL,
			PRIMARY KEY (`visitor_id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "visitors`");
	}
}