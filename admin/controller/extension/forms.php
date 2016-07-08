<?php
class ControllerExtensionForms extends Controller {
	public function index(){
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

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

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['breadcrumbs'] = array();

		$data['url'] = $this->url->link('extension/forms', 'token=' . $this->session->data['token'], 'SSL');
		$data['route'] = 'extension/forms';
		$date = date("Y-m-d H:i:s",strtotime($this->request->get['date']));
		$data['test'] = date("Y-m-d H:i:s",strtotime($this->request->get['date']));
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => strip_tags($this->language->get('heading_title')),
			'href' => $this->url->link('extension/forms', 'token=' . $this->session->data['token'], 'SSL')
		);

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

		$number = 30;

		$limit = array(
			'start' => ($page - 1) * $number,
			'end' => $number
			);

		$filter = $this->request->get['filter'];
		$telephone = $this->request->get['telephone'];
		$data['leads'] = $this->model_extension_forms->getData($limit,$filter,$date,$telephone);
		$data_total = $this->model_extension_forms->getTotalData($filter,$date,$telephone);

		$data['add'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['forms_users'] = $this->config->get('forms_user');

		$data['token'] = $this->session->data['token'];

		$pagination = new Pagination();
		$pagination->total = $data_total;
		$pagination->page = $page;
		$pagination->limit = $number;
		$pagination->url = $this->url->link('extension/forms', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/forms.tpl', $data));
	}
}