<?php

class ControllerCheckoutCheckout2 extends Controller
{
    public function save()
    {
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
        $redirect = '';


        unset($this->session->data['shipping_address']);
        unset($this->session->data['shipping_method']);
        unset($this->session->data['shipping_methods']);


        if (!$redirect) {
            $order_data = array();

            $order_data['totals'] = array();
            $total = 0;
            $taxes = $this->cart->getTaxes();

            $this->load->model('extension/extension');

            $sort_order = array();

            $results = $this->model_extension_extension->getExtensions('total');

            foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('total/' . $result['code']);

                    $this->{'model_total_' . $result['code']}->getTotal($order_data['totals'], $total, $taxes);
                }
            }

            $sort_order = array();

            foreach ($order_data['totals'] as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $order_data['totals']);

            $this->load->language('checkout/checkout');

            $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
            $order_data['store_id'] = $this->config->get('config_store_id');
            $order_data['store_name'] = $this->config->get('config_name');

            if ($order_data['store_id']) {
                $order_data['store_url'] = $this->config->get('config_url');
            } else {
                $order_data['store_url'] = HTTP_SERVER;
            }
            $order_data['customer_id'] = '0';
            $order_data['customer_group_id'] = 1;
            $order_data['firstname'] = $this->request->get['name'];
            $order_data['lastname'] = "";
            $order_data['email'] = $this->request->get['email'];
            $order_data['telephone'] = $this->request->get['telephone'];
            $order_data['custom_field'] = isset($this->request->get['custom_field']) ? $this->request->get['custom_field']['account'] : '';


            $order_data['payment_firstname'] = $this->request->get['name'];
            $order_data['payment_lastname'] = $this->request->get['lastname'];
            $this->session->data['guest']['firstname'] = $this->request->get['firstname'];
            $this->session->data['guest']['lastname'] = $this->request->get['lastname'];
            // $order_data['payment_address_1'] = $this->session->data['payment_address']['address_1'];

            $order_data['payment_custom_field'] = (isset($this->request->get['payment_address']['custom_field']) ? $this->request->post['payment_address']['custom_field'] : array());

            $order_data['payment_method'] = '';
            $order_data['payment_code'] = '';
            $order_data['shipping_firstname'] = '';
            $order_data['shipping_lastname'] = '';
            $order_data['shipping_company'] = '';
            $order_data['shipping_address_1'] = '';
            $order_data['shipping_address_format'] = '';
            $order_data['shipping_custom_field'] = array();
            $order_data['shipping_method'] = '';
            $order_data['shipping_code'] = '';
            $this->load->model('catalog/product');
            $order_data['products'] = array();
            $product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
            $quantity = $this->request->get['quantity'];

            if ($product_info) {
                //$option_data = array();

                /*$option_data[] = array(
                        'product_option_id'       => $option['product_option_id'],
                        'product_option_value_id' => $option['product_option_value_id'],
                        'option_id'               => $option['option_id'],
                        'option_value_id'         => $option['option_value_id'],
                        'name'                    => $option['name'],
                        'value'                   => $option['value'],
                        'type'                    => $option['type']
                    );*/
                $order_data['products'][] = array(
                    'key' => $product_info['key'],
                    'product_id' => $product_info['product_id'],
                    'name' => $product_info['name'],
                    'model' => $product_info['model_1'],
                    'option' => "",
                    'recurring' => "",
                    'quantity' => $quantity,
                    'subtract' => $product_info['subtract'],
                    'price' => $this->currency->format($this->tax->calculate($product_info['price_1'], $product_info['tax_class_id'], $this->config->get('config_tax'))),
                    'total' => $this->currency->format($this->tax->calculate($product_info['price_1'], $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity),
                    'href' => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
                );
            }

            // Gift Voucher
            $order_data['vouchers'] = array();

            $order_data['comment'] = "";
            $order_data['total'] = $this->tax->calculate($product_info['price_1'], $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity;

            $order_data['fax'] = '';
            $order_data['payment_company'] = '';
            $order_data['payment_address_1'] = $this->request->post['address'];
            $order_data['payment_address_2'] = '';
            $order_data['payment_city'] = '';
            $order_data['payment_postcode'] = '';
            $order_data['payment_country'] = '';
            $order_data['payment_country_id'] = $this->request->post['country_id'];
            $order_data['payment_zone'] = '';
            $order_data['payment_zone_id'] = '';
            $order_data['payment_address_format'] = '';
            $order_data['shipping_company'] = '';
            $order_data['shipping_address_1'] = $this->request->post['address'];
            $order_data['shipping_address_2'] = '';
            $order_data['shipping_city'] = '';
            $order_data['shipping_postcode'] = '';
            $order_data['shipping_country'] = '';
            $order_data['shipping_country_id'] = $this->request->post['country_id'];
            $order_data['shipping_zone'] = '';
            $order_data['shipping_zone_id'] = '';
            $order_data['shipping_address_format'] = '';
            if (!isset($this->request->cookie['tracking'])) {
                $order_data['tracking'] = $this->request->cookie['tracking'];

                $subtotal = $this->cart->getSubTotal();

                // Affiliate
                $this->load->model('affiliate/affiliate');

                $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

                if ($affiliate_info) {
                    $order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
                    $order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
                } else {
                    $order_data['affiliate_id'] = 0;
                    $order_data['commission'] = 0;
                }

                // Marketing
                $this->load->model('checkout/marketing');

                $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

                if ($marketing_info) {
                    $order_data['marketing_id'] = $marketing_info['marketing_id'];
                } else {
                    $order_data['marketing_id'] = 0;
                }

                $order_data['affiliate_id'] = 0;
                $order_data['commission'] = 0;
                $order_data['marketing_id'] = 0;
                $order_data['tracking'] = '';


                $order_data['language_id'] = $this->config->get('config_language_id');
                $order_data['currency_id'] = $this->currency->getId();
                $order_data['currency_code'] = $this->currency->getCode();
                $order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
                $order_data['ip'] = $this->request->server['REMOTE_ADDR'];

                if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
                    $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
                } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
                    $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
                } else {
                    $order_data['forwarded_ip'] = '';
                }

                if (isset($this->request->server['HTTP_USER_AGENT'])) {
                    $order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
                } else {
                    $order_data['user_agent'] = '';
                }

                if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
                    $order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
                } else {
                    $order_data['accept_language'] = '';
                }

                $this->load->model('checkout/order');
//$this->response->setOutput(print_r($order_data));
                $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);
                $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], 1);
                $order_data['date']= date("Y-m-d G:i:s");
				$order_data['form_id'] = "order";
                $order_data['name'] = $order_data['firstname'];
				$this->load->model('module/forms');
				$this->model_module_forms->addData($order_data);
			$data['text_recurring_item'] = $this->language->get('text_recurring_item');
			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');

			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');

			$this->load->model('tool/upload');



			// Gift Voucher
			$data['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
                foreach ($this->session->data['vouchers'] as $voucher) {
                    $data['vouchers'][] = array(
                        'description' => $voucher['description'],
                        'amount' => $this->currency->format($voucher['amount'])
                    );
                }
            }

			$data['totals'] = array();

			foreach ($order_data['totals'] as $total) {
                $data['totals'][] = array(
                    'title' => $total['title'],
                    'text' => $this->currency->format($total['value']),
                );
            }

			// $data['payment'] = $this->load->controller('payment/' . $this->request->post['payment_method'].'/confirm');
		} else {
                $data['redirect'] = $redirect;
            }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
// print_r($data['payment']);
            if (!empty($this->session->data['order_id'])) {
                //$json['success'] = 'yes';
                $json['success'] = 'yes';
            } else {
                $json['success'] = 'no';

            }
        }
        // $json['data'] = $this->request->post;


        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}