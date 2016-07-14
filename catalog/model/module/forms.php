<?php
class ModelModuleForms extends Model {
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


  $comment = $this->db->query("SELECT comments FROM `" . DB_PREFIX . "forms_data` WHERE `data_id` = '".(int)$data['data_id']."'");

  $comments = array();
  if(isset($comment->row['comments'])){
   $comments = unserialize($comment->row['comments']);
  }

  if(!empty($data['comment'])){

   $comments[date ("Y-m-d H:i:s", time())] = $data['comment'];
   $this->db->query("INSERT INTO `" . DB_PREFIX . "forms_data` SET `form_id` = '" . $this->db->escape($data['form_id']) . "', `customer_id` = '" . (int)$customer_id . "', `email` = '" . (isset($data['email'])?$this->db->escape($data['email']):'') . "', `name` = '" . $this->db->escape($data['name']) . "', `date` = '" . $this->db->escape($data['date'])  . "', `telephone` = '" . $this->db->escape($data['telephone']) . "', comments = '" . serialize($comments) . "',status_id = '".(int)$data['status']."', `add` = '" . (isset($data['add'])?$this->db->escape(serialize($data['add'])):'') . "'");
  } else {
    $this->db->query("INSERT INTO `" . DB_PREFIX . "forms_data` SET `form_id` = '" . $this->db->escape($data['form_id']) . "', `customer_id` = '" . (int)$customer_id . "', `email` = '" . (isset($data['email']) ? $this->db->escape($data['email']) : '') . "', `name` = '" . $this->db->escape($data['name']) . "', `date` = '" . $this->db->escape($data['date']) . "', `telephone` = '" . $this->db->escape($data['telephone']) . "',status_id = '" . (int)$data['status'] . "', `add` = '" . (isset($data['add']) ? $this->db->escape(serialize($data['add'])) : '') . "'");
  }


  // Send to main admin email if new account email is enabled
  if ($this->config->get('config_account_mail')) {
   $this->load->language('mail/customer');

   $message  = '<b>' . $this->language->get('text_signup') . "</b><br><br>\n\n";
   $message .= '<b>' . $this->language->get('text_website') . '</b> ' . $this->config->get('config_name') . "<br>\n";
   $message .= '<b>' . $this->language->get('text_firstname') . '</b> ' . $name[0] . "<br>\n";
   $message .= '<b>' . $this->language->get('text_lastname') . '</b> ' . (isset($name[1])?$this->db->escape($name[1]):'') . "<br>\n";
   // $message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
   $message .= '<b>' . $this->language->get('text_email') . '</b> '  .  $data['email'] . "<br>\n";
   $message .= '<b>' . $this->language->get('text_telephone') . '</b> ' . $data['telephone'] . "<br><br>\n\n";

   foreach ($data['add'] as $key => $value) {
    $message .= "<b>" . $key . ':</b> ' . $value . "<br>\n";
   }

   $mail = new Mail();
   $mail->protocol = $this->config->get('config_mail_protocol');
   $mail->parameter = $this->config->get('config_mail_parameter');
   $mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
   $mail->smtp_username = $this->config->get('config_mail_smtp_username');
   $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
   $mail->smtp_port = $this->config->get('config_mail_smtp_port');
   $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
   $mail->setSubject($this->language->get('text_new_customer'));
   // $mail->setText($message);
   $mail->setHtml($message);

   $mail->setTo($this->config->get('config_email'));
   $mail->setFrom($this->config->get('config_email'));
   $mail->setSender($this->config->get('config_name'));

   $mail->send();

   // Send to additional alert emails if new account email is enabled
   $emails = explode(',', $this->config->get('config_mail_alert'));

   foreach ($emails as $email) {
    if (utf8_strlen($email) > 0 && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
     $mail->setTo($email);
     $mail->send();
    }
   }
  }




  return true;
 }
}