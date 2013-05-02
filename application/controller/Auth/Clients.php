<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Clients extends Controller{
		public function main() {
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

			$clients = $this->load->model('Admin/Clients_Model');
			//1 get all implementations

			//if add or edit
			$view_data = array(
				'title' => 'JCA Admin Clients',
				'action' => $action,	
				'id' => $id,
			);

			

			

			if(!empty($id))
				$view_data['id'] = $id;

			$validateFields = array(
				array('name' => 'company_name', 'label' => 'Company Name', 'validation' => 'required'),
				array('name' => 'address', 'label' => 'Address', 'validation' => 'required'),
			);

			if($this->form->validate($validateFields)) {
				if(!$clients->isClientExist($this->form->post['company_name'],$id)){
					if($action == 'add')
						$clients->addClient($this->form->post,$this->session->sessionData['user_id']);
					else if ($action == 'edit'){
						$clients->updateClient($this->form->post,$this->session->sessionData['user_id'],$id);
					}
				} else {
					$this->form->errors = array('Company already exist');
				}
			}
			
			if(!empty($id)) {
				$client = $clients->getClient($id);

				$view_data['company_name'] = $client['company_name'];
				$view_data['address'] = $client['address'];
				$view_data['contact_person'] = $client['contact_person'];
				$view_data['position'] = $client['position'];
				$view_data['contact_number'] = $client['contact_number'];
			}

			$view_data['clients'] = $clients->getClients();
			$this->load->view('Auth/Clients', $view_data);
		}
	}
?>