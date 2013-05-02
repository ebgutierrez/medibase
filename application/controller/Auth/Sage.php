<?php

	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Sage extends Controller { 

		public function main(){

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$products = $this->load->model('Admin/Sage_Model');

			$view_data = array();
			$action = 'add';

			$view_data['title'] = 'JCA Sage Products';
			$view_data['action'] = $action;
			$view_data['products'] = $products->getProducts();


			$this->load->view('Auth/Sage_Products',$view_data);	
		}

		public function products(){

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$products = $this->load->model('Admin/Sage_Model');

			$view_data = array();
			$action = 'add';

			$view_data['title'] = 'JCA Sage Products';
			$view_data['action'] = $action;
			$view_data['products'] = $products->getProducts();


			$this->load->view('Auth/Sage_Products',$view_data);	
		}

		public function addProduct(){
			$products = $this->load->model('Admin/Sage_Model');
			$post = $this->form->post;

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			if(!count($post))
				$this->load->controller('Auth/Sage/products');

			$view_data = array();
			$action = 'add';

			$view_data['title'] = 'JCA Sage Products';
			$view_data['action'] = $action;
			$view_data['products'] = $products->getProducts();

			$validateFields = array(
				array('name' => 'name',  'label' => 'Name', 'validation' => 'required'),
				array('name' => 'price',  'label' => 'Price', 'validation' => 'required|filter=currency'),
				array('name' => 'brief_desc',  'label' => 'Brief Description', 'validation' => 'required'),
				array('name' => 'desc',  'label' => 'Description', 'validation' => 'required'),
			);

			if($this->form->validate($validateFields)){
				if(!$products->isProductExist($post['name'])) {
					if(strlen(trim($this->form->file["img"]["name"])) > 0){


						if($this->form->validateFile('img', 'sage_' . $post['name'] . '_' . date('Ymdhis',time()) . '_' . $this->form->file["img"]["name"])) {
							chmod($_SERVER['image'], 0777);

					      	if(move_uploaded_file(
					      		$this->form->file["img"]["tmp_name"],
					      		$_SERVER['image'] ."/" . $this->form->file["img"]["name"]
					      	)) {
					      		$products->addProduct($post,$this->form->file,$this->session->sessionData['user_id']);
					      		$this->load->controller('Auth/Sage/products');
					      	}
						} else {
							$this->load->view('Auth/Sage_Products',$view_data);
						}
					} else {
						$this->form->errors = array('Image is empty');
						$this->load->view('Auth/Sage_Products',$view_data);
					}
					
				} else {
					$this->form->errors = array('Product "' .$post['name'] . '" already exist.');
					$this->load->view('Auth/Sage_Products',$view_data);
				}
			} else {
				$this->load->view('Auth/Sage_Products',$view_data);	
			}		
		}

		public function editProduct(){
			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$products = $this->load->model('Admin/Sage_Model');
			$post = $this->form->post;
			$id = '';
			

			$view_data = array();
			$action = 'edit';

			$id = $this->uri->get['id'];

			$view_data['title'] = 'JCA Sage Products';
			$view_data['action'] = $action;
			$view_data['products'] = $products->getProducts();
			$product = $products->getProduct($id);

			$view_data['id'] = $id;
			$view_data['name'] = $product['name'];
			$view_data['price'] = $product['price'];
			$view_data['img'] = $product['image'];
			$view_data['brief_desc'] = $product['brief_description'];
			$view_data['desc'] = $product['description'];


			$validateFields = array(
				array('name' => 'name',  'label' => 'Name', 'validation' => 'required'),
				array('name' => 'price',  'label' => 'Price', 'validation' => 'required|filter=currency'),
				array('name' => 'brief_desc',  'label' => 'Brief Description', 'validation' => 'required'),
				array('name' => 'desc',  'label' => 'Description', 'validation' => 'required'),
			);

			if($this->form->validate($validateFields)){
				if(!$products->isProductExist($post['name'],$id)) {
					if(strlen(trim($this->form->file["img"]["name"])) > 0){


						if($this->form->validateFile('img', 'sage_' . $post['name'] . '_' . date('Ymdhis',time()) . '_' . $this->form->file["img"]["name"])) {
							chmod($_SERVER['image'], 0777);

					      	if(move_uploaded_file(
					      		$this->form->file["img"]["tmp_name"],
					      		$_SERVER['image'] ."/" . $this->form->file["img"]["name"]
					      	)) {
					      		$products->updateProduct($post, $id,$this->session->sessionData['user_id'], $this->form->file["img"]["name"]);
						      	$this->load->controller('Auth/Sage/editProduct?id=' . $id);
					      	}
						} else {
							$this->load->view('Auth/Sage_Products',$view_data);
						}
					} else {
						$products->updateProduct($post, $id, $this->session->sessionData['user_id']);
						$this->load->controller('Auth/Sage/editProduct?id=' . $id);
					}
					
				} else {
					$this->form->errors = array('Product "' .$post['name'] . '" already exist.');
					$this->load->view('Auth/Sage_Products',$view_data);
				}
			} else {
				$this->load->view('Auth/Sage_Products',$view_data);	
			}		
		}

		public function removeProduct() {
			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$id = $this->form->post['id'];

			$products = $this->load->model('Admin/Sage_Model');
			echo  $products->removeProduct($id,$this->session->sessionData['user_id']);
		}

		public function implementations(){
			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$action = 'add';
			$id = '';

			if(count($this->uri->get)) {
				if(strlen(trim($this->uri->get['action'])))
					$action = $this->uri->get['action'];
				else
					$action = 'add';

				if($action == 'edit') {
					if(strlen(trim($this->uri->get['id'])))
						$id = $this->uri->get['id'];
					else
						$action = 'id';
				}
			}

			$products = $this->load->model('Admin/Sage_Model');
			//1 get all implementations

			//if add or edit
			$view_data = array(
				'title' => 'JCA Admin Implementations',
				'action' => $action,	
				'id' => $id,
			);

			

			

			if(!empty($id))
				$view_data['id'] = $id;

			$validateFields = array(
				array('name' => 'name', 'label' => 'Name', 'validation' => 'required'),
			);

			if($this->form->validate($validateFields)) {
				if(!$products->isClientExist($this->form->post['name'],strtoupper($this->form->post['type']),$id)){
					if($action == 'add')
						$products->addClient($this->form->post,$this->session->sessionData['user_id']);
					else if ($action == 'edit'){
						$products->updateClient($this->form->post,$this->session->sessionData['user_id'],$id);
					}
				} else {
					$this->form->errors = array('Client already exist');
				}
			}
			
			if(!empty($id)) {
				$client = $products->getClient($id);

				$view_data['name'] = $client['name'];
				$view_data['type'] = $client['type'];
				$view_data['type_id'] = $client['id'];
				$view_data['location'] = $client['location'];
			}

			$view_data['implementations'] = $products->getClients();
			$this->load->view('Auth/Sage_Implementations', $view_data);
		}
	}
?>