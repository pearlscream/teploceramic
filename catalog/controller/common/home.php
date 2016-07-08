<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		//categories product
		$this->load->language('common/home');
		$data['text_header'] = $this->language->get('text_header');
		$data['text_garanty'] = $this->language->get('text_garanty');
		$data['text_count'] = $this->language->get('text_count');
		$data['text_fuck'] = $this->language->get('text_fuck');
		$data['text_name'] = $this->language->get('text_name');
		$data['text_number'] = $this->language->get('text_number');
		$data['text_data'] = $this->language->get('text_data');
		$data['text_add'] = $this->language->get('text_add');
		$data['text_buy'] = $this->language->get('text_buy');




		$data['categories'] = array();

			$results = $this->model_catalog_category->getCategories(59);

			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);

				$data['categories'][] = array(
					'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url)
				);
			}

			$data['products'] = array();

			$filter_data = array(
				'filter_category_id' => "59",
				'filter_filter'      => "",
				'sort'               => "",
				'order'              => "",
				'start'              => "",
				'limit'              => ""
			);

			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				if ($result['image']) {
					$image_big = $this->model_tool_image->resize($result['image'],  $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
				} else {
					$image_big = $this->model_tool_image->resize('placeholder.png',  $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
//
//
//			$data['images'] = array();
//
//			$images_img = $this->model_catalog_product->getProductImages($result['product_id']);
//
//			foreach ($images_img as $image_img) {
//				$data['images'][] = array(
//					'popup' => $this->model_tool_image->resize($image_img['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
//					'thumb' => $this->model_tool_image->resize($image_img['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
//				);
//			}
//
//						$data['options'] = array();
//
//			foreach ($this->model_catalog_product->getProductOptions($result['product_id']) as $option) {
//				$product_option_value_data = array();
//
//				foreach ($option['product_option_value'] as $option_value) {
//					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
//						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
//							$option_price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false));
//						} else {
//							$option_price = false;
//						}
//
//						$product_option_value_data[] = array(
//							'product_option_value_id' => $option_value['product_option_value_id'],
//							'option_value_id'         => $option_value['option_value_id'],
//							'name'                    => $option_value['name'],
//							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
//							'price'                   => $option_price,
//							'price_prefix'            => $option_value['price_prefix']
//						);
//					}
//				}
//
//				$data['options'][] = array(
//					'product_option_id'    => $option['product_option_id'],
//					'product_option_value' => $product_option_value_data,
//					'option_id'            => $option['option_id'],
//					'name'                 => $option['name'],
//					'type'                 => $option['type'],
//					'value'                => $option['value'],
//					'required'             => $option['required']
//				);
//			}
//
//						$data['related'] = array();
//
			$related = $this->model_catalog_product->getProductRelated($result['product_id']);
//
//			foreach ($related as $relatede) {
//				if ($result['image']) {
//					$image_related = $this->model_tool_image->resize($relatede['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
//				} else {
//					$image_related = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
//				}
//				if ($result['image']) {
//					$image_related_big = $this->model_tool_image->resize($relatede['image'],  $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
//				} else {
//					$image_related_big = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
//				}
//
//				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
//					$price_related = $this->currency->format($this->tax->calculate($relatede['price'], $relatede['tax_class_id'], $this->config->get('config_tax')));
//				} else {
//					$price_related = false;
//				}
//
//				if ((float)$result['special']) {
//					$special = $this->currency->format($this->tax->calculate($relatede['special'], $relatede['tax_class_id'], $this->config->get('config_tax')));
//				} else {
//					$special = false;
//				}
//
//				if ($this->config->get('config_tax')) {
//					$tax = $this->currency->format((float)$relatede['special'] ? $relatede['special'] : $relatede['price']);
//				} else {
//					$tax = false;
//				}
//
//				if ($this->config->get('config_review_status')) {
//					$rating = (int)$relatede['rating'];
//				} else {
//					$rating = false;
//				}
//            $data['images_related'] = array();
//
//			$images_img_related = $this->model_catalog_product->getProductImages($relatede['product_id']);
//
//			foreach ($images_img_related as $image_img_related) {
//				$data['images_related'][] = array(
//					'popup' => $this->model_tool_image->resize($image_img_related['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
//					'thumb' => $this->model_tool_image->resize($image_img_related['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
//				);
//			}
//				$data['related'][] = array(
//					'product_id'  => $relatede['product_id'],
//					'thumb'       => $image_related,
//					'image_big'       => $image_related_big,
//					'name'        => $relatede['name'],
//					'description' => utf8_substr(strip_tags(html_entity_decode($relatede['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
//					'price'       => $price_related,
//					'model'       => $relatede['model'],
//					'video'       => $relatede['location'],
//					'color'       => $relatede['sku'],
//					'images'       => $data['images_related'],
//					'special'     => $special,
//					'tax'         => $tax,
//					'minimum'     => $relatede['minimum'] > 0 ? $relatede['minimum'] : 1,
//					'rating'      => $rating,
//					'href'        => $this->url->link('product/product', 'product_id=' . $relatede['product_id']),
//					'price_1'  => $relatede['price_1'],
//					'model_1'  => $relatede['model_1']
//				);
//			}
//
			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($result['product_id']);
            		$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'image_big'       => $image_big,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'model'       => $result['model'],
					'color'       => $result['sku'],
					'special'     => $special,
					'tax'         => $tax,
					'video'       => $result['location'],
					'related'     => $data['related'],
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $result['rating'],
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] ),
					'images'        =>$data['images'],
					'options'        =>$data['options'],
					'attribute_groups'   =>$data['attribute_groups'],
					'sku_1'  => $result['sku_1'],
					'price_1'  => $result['price_1'],
					'model_1'  => $result['model_1']
				);

			}

//print_r($result);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}