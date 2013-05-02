<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Services extends Controller { 

		private $services;

		public function main() {

			$action = 'add';
			$type = 'cat';

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$get = $this->uri->get;

			if(array_key_exists('type', $get) && strlen(trim($get['type'])))
				$type = $get['type'];

			$view_data = array();
			$view_data['title'] = 'JCA Admin Services';


			$this->services = $this->load->model('Admin/Services_Model');
			$view_data['services'] = $this->services->getServices();
			$view_data['action'] = $action;
			$view_data['type'] = $type;

			if($type == 'subcat') 
				$view_data['cats'] = $this->services->getCategories();

			$view_data['cat_id'] = 0;
			$view_data['subcat_id'] = 0;

			$this->load->view('Auth/Services',$view_data);
		}

		public function edit() {
			$action = 'edit';
			$type = 'cat';
			$cat_id = 0;
			$subcat_id = 0;

			$get = $this->uri->get;

			if(array_key_exists('type', $get) && strlen(trim($get['type'])))
				$type = $get['type'];

			if(array_key_exists('cat_id', $get) && strlen(trim($get['cat_id'])))
				$cat_id = $get['cat_id'];

			if(array_key_exists('subcat_id', $get) && strlen(trim($get['subcat_id'])))
				$subcat_id = $get['subcat_id'];


			$view_data = array();
			$view_data['title'] = 'JCA Admin Services';

			if($type == 'subcat')
				$view_data['subcat_id'] = $subcat_id;

			$this->services = $this->load->model('Admin/Services_Model');
			$view_data['services'] = $this->services->getServices();
			$view_data['action'] = $action;
			$view_data['type'] = $type;
			$view_data['cat_id'] = $cat_id;

			$validateFields = array();

			switch ($type) {
				case 'cat':
					$category = $this->services->getCategory($cat_id);

					foreach ($category as $value) {
						$view_data['cat_name'] = $value['name'];
						$view_data['cat_desc'] = $value['description'];
					}

					$view_data['remove_id'] = 'cat_' . $cat_id;

					$validateFields = array(
						array('name' => 'cat_name',  'label' => 'Name', 'validation' => 'required'),
						array('name' => 'cat_desc',  'label' => 'Description', 'validation' => 'required'),
					);
					break;
				case 'subcat':
					$subcategory = $this->services->getSubcategory($cat_id,$subcat_id);

					foreach ($subcategory as $value) {
						$view_data['subcat_name'] = $value['name'];
						$view_data['subcat_desc'] = $value['description'];
						$view_data['subcat_cat'] = $value['category_id'];
						$view_data['subcat_image'] = $value['image'];
					}

					$view_data['cats'] = $this->services->getCategories();
					$view_data['remove_id'] = 'subcat_' . $subcat_id . '_' . $cat_id;

					$validateFields = array(
						array('name' => 'subcat_name',  'label' => 'Name', 'validation' => 'required'),
						array('name' => 'subcat_desc',  'label' => 'Description', 'validation' => 'required'),
						array('name' => 'cat_id',  'label' => 'Category', 'validation' => 'required'),
					);

					break;
				default:
					# code...
					break;
			}

			if($this->form->validate($validateFields)) {
				switch($type) {
					case 'cat':
						if(!$this->services->isCategoryExist($this->form->post['cat_name'],$cat_id)) {
							$this->services->updateCategory($this->form->post,$cat_id,$this->session->sessionData['user_id']);
							//$this->services->addCategory($this->form->post,$this->session->sessionData['user_id']);
							$this->load->controller('Auth/Services/edit?type='. $type . '&cat_id=' . $cat_id);
						} else {
							$this->form->errors = array('Category "' . $this->form->post['cat_name'] . '" already exist.');
							$this->load->view('Auth/Services',$view_data);
						}
						break;
					case 'subcat':
						if(!$this->services->isSubcategoryExist($this->form->post['subcat_name'],$this->form->post['cat_id'],$subcat_id)) {
							if(strlen(trim($this->form->file["subcat_image"]["name"])) > 0){


								if($this->form->validateFile('subcat_image',$this->form->post['cat_id'] . '_' . $this->form->post['subcat_name'] . '_' . date('Ymdhis',time()) . '_' . $this->form->file["subcat_image"]["name"])) {
									chmod($_SERVER['image'], 0777);

							      	if(move_uploaded_file(
							      		$this->form->file["subcat_image"]["tmp_name"],
							      		$_SERVER['image'] ."/" . $this->form->file["subcat_image"]["name"]
							      	)) {

							      		$this->services->updateSubcategory($this->form->post,$this->form->post['cat_id'],$subcat_id,$this->sessopm->sessionData['user_id'],$this->form->file["subcat_image"]["name"]);
							      		$this->load->controller('Auth/Services/edit?type=' . $type . '&cat_id=' . $this->form->post['cat_id'] . '&subcat_id=' . $subcat_id);
							      	}
								} else {
									$this->load->view('Auth/Services',$view_data);
								}
							} else {
								$this->services->updateSubcategory($this->form->post,$this->form->post['cat_id'],$subcat_id,$this->sessopm->sessionData['user_id'],$this->form->file["subcat_image"]["name"]);
					      		$this->load->controller('Auth/Services/edit?type=' . $type . '&cat_id=' . $this->form->post['cat_id'] . '&subcat_id=' . $subcat_id);
							}
							//$this->services->addCategory($this->form->post,$this->session->sessionData['user_id']);
							//$this->load->controller('Auth/Services?type=' . $type);
						} else {
							$this->form->errors = array('Subcategory "' . $this->form->post['subcat_name'] . '" already exist.');
							$this->load->view('Auth/Services',$view_data);
						}
						break;
				}
				
			} else {
				$this->load->view('Auth/Services',$view_data);	
			}

			
		}

		public function add(){
			$type = 'cat';		

			$post = $this->form->post;

			if(!count($post))
				$this->load->controller('Auth/Services');

			if(array_key_exists('type', $post) && strlen(trim($post['type'])))
				$type = $post['type'];

			$validateFields = array();

			$view_data['title'] = 'JCA Admin Services';


			$this->services = $this->load->model('Admin/Services_Model');
			$view_data['services'] = $this->services->getServices();
			$view_data['action'] = 'add';
			$view_data['type'] = $type;

			if($type == 'subcat') 
				$view_data['cats'] = $this->services->getCategories();

			$view_data['cat_id'] = 0;
			$view_data['subcat_id'] = 0;

			switch($type) {
				case 'cat':
					$validateFields = array(
						array('name' => 'cat_name',  'label' => 'Name', 'validation' => 'required'),
						array('name' => 'cat_desc',  'label' => 'Description', 'validation' => 'required'),
					);
					break;
				case 'subcat':
					$validateFields = array(
						array('name' => 'subcat_name',  'label' => 'Name', 'validation' => 'required'),
						array('name' => 'subcat_desc',  'label' => 'Description', 'validation' => 'required'),
						array('name' => 'cat_id',  'label' => 'Category', 'validation' => 'required'),
					);
					break;
			}

			if($this->form->validate($validateFields)) {
				switch($type) {
					case 'cat':
						if(!$this->services->isCategoryExist($this->form->post['cat_name'])) {
							$this->services->addCategory($this->form->post,$this->session->sessionData['user_id']);
							$this->load->controller('Auth/Services?type=' . $type);
						} else {
							$this->form->errors = array('Category "' . $this->form->post['cat_name'] . '" already exist.');
							$this->load->view('Auth/Services',$view_data);
						}
						break;
					case 'subcat':
						if(!$this->services->isSubcategoryExist($this->form->post['subcat_name'],$this->form->post['cat_id'])) {
							if(strlen(trim($this->form->file["subcat_image"]["name"])) > 0){


								if($this->form->validateFile('subcat_image',$this->form->post['cat_id'] . '_' . $this->form->post['subcat_name'] . '_' . date('Ymdhis',time()) . '_' . $this->form->file["subcat_image"]["name"])) {
									chmod($_SERVER['image'], 0777);

							      	if(move_uploaded_file(
							      		$this->form->file["subcat_image"]["tmp_name"],
							      		$_SERVER['image'] ."/" . $this->form->file["subcat_image"]["name"]
							      	)) {
							      		$this->services->addSubcategory($this->form->post, $this->form->file,$this->form->post['cat_id'],$this->session->sessionData['user_id']);
							      		$this->load->controller('Auth/Services?type=' . $type);
							      	}
								} else {
									$this->load->view('Auth/Services',$view_data);
								}
							} else {
								$this->form->errors = array('Image is empty');
								$this->load->view('Auth/Services',$view_data);
							}
							//$this->services->addCategory($this->form->post,$this->session->sessionData['user_id']);
							//$this->load->controller('Auth/Services?type=' . $type);
						} else {
							$this->form->errors = array('Subcategory "' . $this->form->post['subcat_name'] . '" already exist.');
							$this->load->view('Auth/Services',$view_data);
						}
						break;
				}
				
			} else {
				$this->load->view('Auth/Services',$view_data);
			}
		}
	}
?>