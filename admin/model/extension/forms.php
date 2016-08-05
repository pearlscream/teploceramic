<?php
class ModelExtensionForms extends Model {
	public function getData($limit,$filter,$date_start,$date_end,$telephone) {

		//SELECT * FROM `la_forms_data` as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as tratment FROM `la_forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid ORDER BY `data_id` DESC
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data`as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);

		if ($filter == 'month') {
//			$query = $this->db->query("SELECT *,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m') = date_format(now(), '%Y%m') GROUP BY telephone ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data`as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid AND date_format(date, '%Y%m') = date_format(now(), '%Y%m') ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);
		}

		if ($filter == 'year') {
//			$query = $this->db->query("SELECT *,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y') = date_format(now(), '%Y') GROUP BY telephone ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data`as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid AND date_format(date, '%Y') = date_format(now(), '%Y') ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);
		}

		if ($filter == 'week') {
//			$query = $this->db->query("SELECT *,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` where year(date) = year(now()) and week(date, 1) = week(now(), 1) GROUP BY telephone ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data`as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid AND year(date) = year(now()) and week(date, 1) = week(now(), 1) ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);
		}
		if (isset($date_start) && $date_start != date("Y-m-d H:i:s",strtotime('')) && $date_end != '') {
//			$query = $this->db->query("SELECT *,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m%d') = date_format('" . $date . "', '%Y%m%d') GROUP BY telephone ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data`as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid AND date_format(date, '%Y%m%d') >= date_format('" . $date_start . "', '%Y%m%d') AND date_format(date, '%Y%m%d') <= date_format('" . $date_end . "', '%Y%m%d') ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);
		}

		if ($filter == 'get_back(1)' || $filter == 'get_back(2)' || $filter == "middle_form" || $filter == "have_question" || $filter == "call" || $filter == "order") {
			if ($filter != "middle_form") {
				$filter=str_replace("_", " ", $filter);
			}
//			$query = $this->db->query("SELECT *,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` where form_id = '" . $filter . "' GROUP BY telephone ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data`as data1,(SELECT telephone,MAX(data_id) as maxid,COUNT(telephone) as treatment FROM `la_forms_data` GROUP BY telephone) as data2 WHERE data2.telephone = data1.telephone AND data1.data_id = data2.maxid AND form_id = '" . $filter . "' ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);
		}

		if (isset($telephone)) {
			$query = $this->db->query("SELECT *, REPLACE(REPLACE(REPLACE(REPLACE(telephone,'-',''),' ',''),')',''),'(','') as phone,COUNT(telephone) as treatment FROM `" . DB_PREFIX . "forms_data` GROUP BY telephone HAVING phone like '". $telephone ."%' ORDER BY `data_id` DESC");
		}
//		$query = $this->db->query("select * from `la_forms_data` where date_format(date, '%Y%m') = date_format(now(), '%Y%m')");


		$data = array();
		foreach ($query->rows as $row) {
			$data[] = array(
				'data_id'     => $row['data_id'],
				'form_id'     => $row['form_id'],
				'customer_id' => $row['customer_id'],
				'name'        => $row['name'],
				'email'       => $row['email'],
				'telephone'   => $row['telephone'],
				'date'   	  => $row['date'],
				'add'         => unserialize($row['add']),
				'status_id'   => $row['status_id'],
				'comments'    => unserialize($row['comments']),
				'treatment'   => $row['treatment'],
				);
		}
// print_r(unserialize($row['comments']));
		return $data;
	}
	public function getTotalData($filter, $date_start,$date_end,$telephone) {
		$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data`");

		if ($filter == 'month') {
			$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m') = date_format(now(), '%Y%m'");
		}

		if ($filter == 'year') {
			$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y') = date_format(now(), '%Y' `data_id` DESC");
		}
		if ($filter == 'week') {
			$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data` where year(date) = year(now()) and week(date, 1) = week(now(), 1) `data_id` DESC");
		}
		if ($filter == 'get_back' || $filter == "middle_form" || $filter == "have_questions") {
			$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data` where form_id = " . $filter . " `data_id` DESC");
		}

		if (isset($date_start) && $date_start != date("Y-m-d H:i:s",strtotime('')) && $date_end != '') {
			$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m%d') >= date_format('" . $date_start . "', '%Y%m%d') AND date_format(date, '%Y%m%d') <= date_format('" . $date_end . "', '%Y%m%d')");

		}

		if ($filter == 'get_back(1)' || $filter == 'get_back(2)' || $filter == "middle_form" || $filter == "have_question" || $filter == "call" || $filter == "order") {
			if ($filter != "middle_form") {
				$filter=str_replace("_", " ", $filter);
			}
			$query = $this->db->query("SELECT count(DISTINCT  telephone) as total FROM `" . DB_PREFIX . "forms_data` where form_id = '" . $filter . "'");
		}

		if (isset($telephone)) {
			$query = $this->db->query("SELECT count(DISTINCT phone) as total, REPLACE(REPLACE(REPLACE(REPLACE(telephone,'-',''),' ',''),')',''),'(','') as phone FROM `" . DB_PREFIX . "forms_data` HAVING phone like '". $telephone ."%' ");
		}
		//SELECT *, REPLACE(REPLACE(REPLACE(REPLACE(telephone,'-',''),' ',''),')',''),'(','') as phone FROM `la_forms_data` HAVING phone like '067%'
		return $query->row['total'];
	}

	public function editData($data) {
// print_r($data);
		$comment = $this->db->query("SELECT comments FROM `" . DB_PREFIX . "forms_data` WHERE `data_id` = '".(int)$data['data_id']."'");

		$comments = array();
		if(isset($comment->row['comments'])){
			$comments = unserialize($comment->row['comments']);
		}

		if(!empty($data['comment'])){

			$comments[date ("Y-m-d H:i:s", time())] = $data['comment'];
			$this->db->query("UPDATE `" . DB_PREFIX . "forms_data` SET status_id = '".(int)$data['status'] . "', date = '" . $data['date'] . "', comments = '" . serialize($comments) . "' WHERE data_id = '".(int)$data['data_id']."'");
		}else{
			$this->db->query("UPDATE `" . DB_PREFIX . "forms_data` SET date = '".$data['date'] ."',status_id = '".(int)$data['status']."' WHERE data_id = '".(int)$data['data_id']."'");
		}

		return $comments;
	}

	public function addData($data) {

		$forms_users = $this->config->get('forms_user');
		$customer_group_id = 1;
		foreach ($forms_users as $user) {
			if($data['form_id'] == $user['form_id']){
				$customer_group_id = $user['customer_group_id'];
			}
		}
		$name = explode(' ', $data['name']);

		//add customer
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($name[0]) . "', lastname = '" . (isset($name[1])?$this->db->escape($name[1]):'') . "', email = '" . (isset($data['email'])?$this->db->escape($data['email']):'') . "', telephone = '" . $this->db->escape($data['telephone']) . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1('Pa$$w0rd')))) . "', newsletter = '0', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '1', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		$this->db->query("INSERT INTO `" . DB_PREFIX . "forms_data` SET `form_id` = '" . $this->db->escape($data['form_id']) . "', `customer_id` = '" . (int)$customer_id . "', `email` = '" . (isset($data['email'])?$this->db->escape($data['email']):'') . "', `name` = '" . $this->db->escape($data['name']) . "', `date` = '" . $this->db->escape($data['date'])  . "', `telephone` = '" . $this->db->escape($data['telephone']) . "', `add` = '" . (isset($data['add'])?$this->db->escape(serialize($data['add'])):'') . "'");

		return true;
	}

	public function removeData($lead_id) {
		$query = $this->db->query("DELETE FROM `" . DB_PREFIX . "forms_data` WHERE data_id = '". $lead_id . "'");
		return true;
	}

	public function getPhones($telephone) {
		$query = $this->db->query("SELECT *, REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(telephone,'_',''),'-',''),' ',''),')',''),'(','') as phone FROM `" . DB_PREFIX . "forms_data` HAVING phone like '". $telephone ."' ORDER BY `data_id` ASC");
		$data = array();
		foreach ($query->rows as $row) {
			$data[] = array(
				'data_id'     => $row['data_id'],
				'form_id'     => $row['form_id'],
				'customer_id' => $row['customer_id'],
				'name'        => $row['name'],
				'email'       => $row['email'],
				'telephone'   => $row['telephone'],
				'date'   	  => $row['date'],
				'add'         => unserialize($row['add']),
				'status_id'   => $row['status_id'],
				'comments'    => unserialize($row['comments']),
			);
		}
		return $data;
	}

	public function getPhoneSearch($telephone) {
		$query = $this->db->query("SELECT telephone, REPLACE(REPLACE(REPLACE(REPLACE(telephone,'-',''),' ',''),')',''),'(','') as phone FROM `" . DB_PREFIX . "forms_data` HAVING phone like '". $telephone ."%' ORDER BY `data_id` DESC LIMIT 0,10");
		$data = array();
		foreach ($query->rows as $row) {
			$data[] = array(
				'telephone'   => $row['telephone'],
			);
		}
		return $data;
	}
}