<?php
class ModelExtensionVisitors extends Model {

	////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////// Visitors //////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////

	public function getTotalVisitors() {
		$query = $this->db->query("SELECT COUNT(DISTINCT ip) as visitors FROM `" . DB_PREFIX . "visitors` ");

		return $query->row['visitors'];
	}

	public function getTotalVisitorsByDay() {
		$customer_data = array();

		for ($i = 0; $i < 24; $i++) {
			$customer_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(DISTINCT ip) AS total, HOUR(`date`) AS hour FROM `" . DB_PREFIX . "visitors` WHERE DATE(`date`) = DATE(NOW()) GROUP BY HOUR(`date`) ORDER BY `date` ASC");

		foreach ($query->rows as $result) {
			$customer_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalVisitorsByWeek() {
		$customer_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(DISTINCT ip) AS total, `date` FROM `" . DB_PREFIX . "visitors` WHERE DATE(`date`) >= DATE('" . $this->db->escape(date('Y-m-d', $date_start)) . "') GROUP BY DAYNAME(`date`)");

		foreach ($query->rows as $result) {
			$customer_data[date('w', strtotime($result['date']))] = array(
				'day'   => date('D', strtotime($result['date'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalVisitorsByMonth() {
		$customer_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$customer_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(DISTINCT ip) AS total, `date` FROM `" . DB_PREFIX . "visitors` WHERE DATE(`date`) >= '" . $this->db->escape(date('Y') . '-' . date('m') . '-1') . "' GROUP BY DATE(`date`)");

		foreach ($query->rows as $result) {
			$customer_data[date('j', strtotime($result['date']))] = array(
				'day'   => date('d', strtotime($result['date'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalVisitorsByYear() {
		$customer_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$customer_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(DISTINCT ip) AS total, `date` FROM `" . DB_PREFIX . "visitors` WHERE YEAR(`date`) = YEAR(NOW()) GROUP BY MONTH(`date`)");

		foreach ($query->rows as $result) {
			$customer_data[date('n', strtotime($result['date']))] = array(
				'month' => date('M', strtotime($result['date'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////// Visits ////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////


	public function getTotalViews() {
		$query = $this->db->query("SELECT COUNT(*) as views FROM `" . DB_PREFIX . "visitors` ");//GROUP BY `ip`

		return $query->row['views'];
	}

	public function getTotalVisitsByDay() {
		$customer_data = array();

		for ($i = 0; $i < 24; $i++) {
			$customer_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(`date`) AS hour FROM `" . DB_PREFIX . "visitors` WHERE DATE(`date`) = DATE(NOW()) GROUP BY HOUR(`date`) ORDER BY `date` ASC");

		foreach ($query->rows as $result) {
			$customer_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalVisitsByWeek() {
		$customer_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, `date` FROM `" . DB_PREFIX . "visitors` WHERE DATE(`date`) >= DATE('" . $this->db->escape(date('Y-m-d', $date_start)) . "') GROUP BY DAYNAME(`date`)");

		foreach ($query->rows as $result) {
			$customer_data[date('w', strtotime($result['date']))] = array(
				'day'   => date('D', strtotime($result['date'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalVisitsByMonth() {
		$customer_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$customer_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, `date` FROM `" . DB_PREFIX . "visitors` WHERE DATE(`date`) >= '" . $this->db->escape(date('Y') . '-' . date('m') . '-1') . "' GROUP BY DATE(`date`)");

		foreach ($query->rows as $result) {
			$customer_data[date('j', strtotime($result['date']))] = array(
				'day'   => date('d', strtotime($result['date'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalVisitsByYear() {
		$customer_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$customer_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, `date` FROM `" . DB_PREFIX . "visitors` WHERE YEAR(`date`) = YEAR(NOW()) GROUP BY MONTH(`date`)");

		foreach ($query->rows as $result) {
			$customer_data[date('n', strtotime($result['date']))] = array(
				'month' => date('M', strtotime($result['date'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}
}