<?php
class ControllerModuleBlock extends Controller {
	public function index($setting) {

		$this->load->model('tool/image');

		if (isset($setting['code'])) {
			$code = $setting['code'];
			foreach ($setting['fields'][$this->config->get('config_language_id')] as $key => $field) {
				if(isset($field['type'])){
					$code = $this->renderFields($code ,$key, $field);
				}else{
					preg_match_all('/\{\{group +name=[\'"]' . $key . '[\'"].*\}\}(.*)\{\{\/group\}\}/Us', html_entity_decode($code, ENT_QUOTES, 'UTF-8'), $group);

// print_r($group);
					$group_code = '';
					foreach ($field as $key2 => $fields2) {
						$group2 = $group[1][0];
						foreach ($fields2 as $key3 => $field3) {
							$group2 = $this->renderFields($group2 ,$key3, $field3);
						}
						$group_code .= $group2;
					}
// print_r($group_code);

					$code = preg_replace('/\{\{group +name=[\'"]' . $key . '[\'"].*\}\}(.*)\{\{\/group\}\}/Us', $group_code, html_entity_decode($code, ENT_QUOTES, 'UTF-8'));
				}
			}

			$data['block'] = html_entity_decode($code, ENT_QUOTES, 'UTF-8');
			$data['base'] = $this->config->get('config_url');
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/block.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/block.tpl', $data);
			} else {
				return $this->load->view('default/template/module/block.tpl', $data);
			}
		}
	}

	private function renderFields($code ,$key, $field){
		$pre_key = preg_replace('/([\*\(\)\/\?\!\&\-\+])/', '\\\$1', urldecode($key));
// print_r($pre_key);
		if($field['type'] != 'img' && $field['type'] != 'limg'){
			// print_r($pre_key);
			// html_entity_decode($cpre_keyode, ENT_QUOTES, 'UTF-8');
			$code = preg_replace('/\{\{' . html_entity_decode($pre_key, ENT_QUOTES, 'UTF-8') . '\|{0,1}.*\}\}/Um', $field['value'], html_entity_decode($code, ENT_QUOTES, 'UTF-8'));
		}elseif($field['type'] == 'img'){
			if(strpos($field['value'], 'view') === false){
				list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $field['value']);

				if (!$field['height'] && !$field['width']){
					$field['width']  = $width_orig;
					$field['height'] = $height_orig;
				}else{
					if (!$field['height']){
						$field['height'] = $field['width'] / ($width_orig / $height_orig);
					}
					if (!$field['width']){
						$field['width'] = $field['height'] / ($height_orig / $width_orig);
					}
				}
				preg_match('/\{\{.*' . $pre_key . '.*?(class=[\'"].*[\'"]).*?\|{0,1}.*\}\}/Um', $code, $iclass);
				$code = preg_replace('/\{\{.*' . $pre_key . '.*?\|{0,1}.*\}\}/Um', '<img src="' . str_replace(" ", "%20", $this->model_tool_image->resize($field['value'], $field['width'], $field['height'])) . '" width="' . $field['width']. '" height="' . $field['height']. '" alt="' . $field['alt']. '" title="' . $field['title']. '"' . ($iclass?' ' . $iclass[1]:'') .' />', $code);
			}else{
				preg_match('/\{\{.*' . $pre_key . '.*?(class=[\'"].*[\'"]).*?\|{0,1}.*\}\}/Um', $code, $iclass);
				$code = preg_replace('/\{\{.*' . $pre_key . '.*?\|{0,1}.*\}\}/Um', '<img src="' . str_replace(" ", "%20",$field['value']) . '" width="' . $field['width']. '" height="' . $field['height']. '" alt="' . $field['alt']. '" title="' . $field['title']. '"' . ($iclass?' ' . $iclass[1]:'') .' />', $code);
			}

		}elseif($field['type'] == 'limg'){
			if(strpos($field['value'], 'view') === false){
				list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $field['value']);

				if (!$field['height'] && !$field['width']){
					$field['width']  = $width_orig;
					$field['height'] = $height_orig;
				}else{
					if (!$field['height']){
						$field['height'] = $field['width'] / ($width_orig / $height_orig);
					}
					if (!$field['width']){
						$field['width'] = $field['height'] / ($height_orig / $width_orig);
					}
				}
				preg_match('/\{\{(.*' . $pre_key . '.*?\|{0,1}.*)\}\}/Um', html_entity_decode($code, ENT_QUOTES, 'UTF-8'), $lcode);
				$lcode2 = explode('|', $lcode[1]);
				$img = '<img src="' . str_replace(" ", "%20",$this->model_tool_image->resize($field['value'], $field['width'], $field['height'])) . '" width="' . $field['width']. '" height="' . $field['height']. '" alt="' . $field['alt']. '" title="' . $field['title']. '" />';
				$lcode3 = preg_replace('/<img.*>/U', $img, $lcode2[0]);
				$lcode3 = preg_replace('/href=[\'"].*[\'"]/U', 'href="' . $this->model_tool_image->resize($field['value'], $width_orig, $height_orig) . '"', $lcode3);
// print_r($lcode3);

				$code = preg_replace('/\{\{.*' . $pre_key . '.*?\|{0,1}.*\}\}/Um', $lcode3, $code);
			}else{
				preg_match('/\{\{(.*' . $pre_key . '.*?\|{0,1}.*)\}\}/Um', html_entity_decode($code, ENT_QUOTES, 'UTF-8'), $lcode);
				$lcode2 = explode('|', $lcode[1]);
				// print_r($lcode2[0]);
				// print_r($field);
				$img = '<img src="' . str_replace(" ", "%20",$field['value']) . '" width="' . $field['width']. '" height="' . $field['height']. '" alt="' . $field['alt']. '" title="' . $field['title']. '" />';
				$lcode3 = preg_replace('/<img.*>/U', $img, $lcode2[0]);
				$lcode3 = preg_replace('/href=[\'"].*[\'"]/U', 'href="' . $field['value'] . '"', $lcode3);
				$code = preg_replace('/\{\{.*' . $pre_key . '.*?\|{0,1}.*\}\}/Um', $lcode3, $code);
			}

		}
		return $code;
	}
}