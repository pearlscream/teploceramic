<?php
class ModelExtensionForms extends Model {
	public function getData($limit,$filter,$date) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data` ORDER BY `data_id` DESC LIMIT ".(int)$limit['start']." , ".(int)$limit['end']);

		if ($filter == 'month') {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m') = date_format(now(), '%Y%m') ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
		}

		if ($filter == 'year') {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y') = date_format(now(), '%Y') ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
		}

		if ($filter == 'week') {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data` where year(date) = year(now()) and week(date, 1) = week(now(), 1) ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
		}
		if (isset($date) && $date != '1970-01-01 03:00:00') {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m%d') = date_format('" . $date . "', '%Y%m%d') ORDER BY `data_id` DESC LIMIT " . (int)$limit['start'] . " , " . (int)$limit['end']);
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
				);
		}
// print_r(unserialize($row['comments']));
		return $data;
	}
	public function getTotalData($filter, $date) {
		$query = $this->db->query("SELECT count(*) as total FROM `" . DB_PREFIX . "forms_data` ");

		if ($filter == 'month') {
			$query = $this->db->query("SELECT count(*) as total FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m') = date_format(now(), '%Y%m'");
		}

		if ($filter == 'year') {
			$query = $this->db->query("SELECT count(*) as total FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y') = date_format(now(), '%Y'");
		}
		if ($filter == 'week') {
			$query = $this->db->query("SELECT count(*) as total FROM `" . DB_PREFIX . "forms_data` where year(date) = year(now()) and week(date, 1) = week(now(), 1)");
		}

		if (isset($date) && $date != '1970-01-01 03:00:00') {
			$query = $this->db->query("SELECT count(*) as total FROM `" . DB_PREFIX . "forms_data` WHERE date_format(date, '%Y%m%d') = date_format('" . $date . "', '%Y%m%d')");
		}



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
			$this->db->query("UPDATE `" . DB_PREFIX . "forms_data` SET status_id = '".(int)$data['status']."', comments = '" . serialize($comments) . "' WHERE data_id = '".(int)$data['data_id']."'");
		}else{
			$this->db->query("UPDATE `" . DB_PREFIX . "forms_data` SET status_id = '".(int)$data['status']."' WHERE data_id = '".(int)$data['data_id']."'");
		}

		return $comments;
	}
}