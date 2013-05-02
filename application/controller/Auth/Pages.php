<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Pages extends Controller {
		public function main(){

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$action = 'add';
			$id = '';

			$view_data = array(
				'title' => 'JCA Admin Pages',
				'act' => $action,
				'id' => $id,
			);
		

			$pages = $this->load->model('Admin/Pages_Model');
			

			$view_data['default_pages'] = $pages->getDefaultPages();
			$view_data['generated_pages'] = $pages->getGeneratedPages();

			$view_data['act'] = $action;
			$this->load->view('Auth/Default_Page',$view_data);
		}

		public function addPage() {
			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$action = 'add';
			$id = '';

			$view_data = array(
				'title' => 'JCA Admin Pages',
				'action' => $action,
				'id' => $id,
			);


			$pages = $this->load->model('Admin/Pages_Model');

			$validateFields = array(
				array('name' => 'name', 'label' => 'Name', 'validation' => 'required'),
				array('name' => 'display_text', 'label' => 'Display Text', 'validation' => 'required'),
				array('name' => 'content', 'label' => 'Content', 'validation' => 'required'),
			);

			if($this->form->validate($validateFields)) {
				if(!$pages->isPageExist($this->form->post['name'],'d',$id)) {
					$pages->addPage($this->form->post);
				} else {
					$this->form->errors = array('Page already exist');
				}
			}

			$view_data['default_pages'] = $pages->getDefaultPages();
			$view_data['generated_pages'] = $pages->getGeneratedPages();
			$this->load->view('Auth/Default_Page',$view_data);
		}

		public function viewPage() {
			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$action = 'edit';
			$id = '';
			$type = '';
			$name = '';

			if(isset($this->uri->get['id']) && strlen(trim($this->uri->get['id'])))
				$id = $this->uri->get['id'];

			if(isset($this->uri->get['type']) && strlen(trim($this->uri->get['type'])))
				$type = $this->uri->get['type'];

			if(isset($this->uri->get['name']) && strlen(trim($this->uri->get['name'])))
				$name = $this->uri->get['name'];


			$view_data = array(
				'title' => 'JCA Admin Pages',
				'action' => $action,
				'id' => $id,
				'type' => $type,
			);		
		

			$pages = $this->load->model('Admin/Pages_Model');
			

			$view_data['default_pages'] = $pages->getDefaultPages();
			$view_data['generated_pages'] = $pages->getGeneratedPages();

			
			$explodedName = explode('_', $name);

			if(count($explodedName) > 1) {
				foreach ($explodedName as &$value) {
					$value = ucfirst($value);
				}
			} else {
				$explodedName[0] = ucfirst($explodedName[0]);
			}

			$name = implode('_', $explodedName);

			$pageData = $pages->getPage($type,$id);

			foreach ($pageData as $data) {
				$view_data['name'] =  $data['name'];
				$view_data['display_text'] =  $data['text'];

				if(strcasecmp($type, 'default') == 0 && strcasecmp($data['name'], 'home') == 0) {
					$contents = json_decode($data['content']);

					foreach ($contents->content as $content) {
						$view_data['mission'] = $content->mission;
						$view_data['vision'] = $content->vision;
					}								
				} else if(strcasecmp($type, 'default') == 0 && strcasecmp($data['name'], 'about_us') == 0) {
					$contents = json_decode($data['content']);

					foreach ($contents->content as $content) {
						$view_data['content'] = $content->content;
					}	
				} else if(strcasecmp($type, 'default') == 0 && strcasecmp($data['name'], 'contact_us') == 0) {
					$contents = json_decode($data['content']);

					foreach ($contents->content as $content) {
						$view_data['company_name'] = $content->company_name;
						$view_data['address'] = $content->address;
						$view_data['email'] = $content->email;
						$view_data['contacts'] = implode(' | ', $content->contacts);
					}	
				} else {
					$view_data['content'] =  $data['content'];	
				}
				
			}

			if($type == 'default')
				$this->load->view('Auth/' . $name . '_Admin_Page',$view_data);
			else
				$this->load->view('Auth/Default_Page',$view_data);
		}

		public function editPage(){
			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');

			$action = 'edit';
			$id = '';
			$type = '';
			$name = '';

			if(isset($this->uri->get['id']) && strlen(trim($this->uri->get['id'])))
				$id = $this->uri->get['id'];

			if(isset($this->uri->get['type']) && strlen(trim($this->uri->get['type'])))
				$type = $this->uri->get['type'];

			if(isset($this->uri->get['name']) && strlen(trim($this->uri->get['name'])))
				$name = $this->uri->get['name'];

			$view_data = array(
				'title' => 'JCA Admin Pages',
				'action' => $action,
				'id' => $id,
				'type' => $type,
			);
				

			$pages = $this->load->model('Admin/Pages_Model');
			

			$validateFields = array(
				array('name' => 'name', 'label' => 'Name', 'validation' => 'required'),
				array('name' => 'display_text', 'label' => 'Display Text', 'validation' => 'required'),				
			);

			if($type == 'default' && $id == 1) {
				$validateFields[] = array('name' => 'mission', 'label' => 'Mission', 'validation' => 'required');
				$validateFields[] = array('name' => 'vision', 'label' => 'Vision', 'validation' => 'required');
			} else if ($type == 'generated') {
				$validateFields[] = array('name' => 'content', 'label' => 'Content', 'validation' => 'required');
			}

			if($this->form->validate($validateFields)){
				if(!$pages->isPageExist($this->form->post['name'],$type,$id)) {
					$pages->savePage($type,$id,$this->form->post);
				} else {
					$this->form->errors = array('Page already exists.');
				}
			}


			$view_data['default_pages'] = $pages->getDefaultPages();
			$view_data['generated_pages'] = $pages->getGeneratedPages();

			
			$explodedName = explode('_', $name);

			if(count($explodedName) > 1) {
				foreach ($explodedName as &$value) {
					$value = ucfirst($value);
				}
			} else {
				$explodedName[0] = ucfirst($explodedName[0]);
			}

			$name = implode('_', $explodedName);

			$pageData = $pages->getPage($type,$id);

			foreach ($pageData as $data) {
				$view_data['name'] =  $data['name'];
				$view_data['display_text'] =  $data['text'];

				if(strcasecmp($type, 'default') == 0 && strcasecmp($data['name'], 'home') == 0) {
					$contents = json_decode($data['content']);

					foreach ($contents->content as $content) {
						$view_data['mission'] = $content->mission;
						$view_data['vision'] = $content->vision;
					}								
				} else if(strcasecmp($type, 'default') == 0 && strcasecmp($data['name'], 'about_us') == 0) {
					$contents = json_decode($data['content']);

					foreach ($contents->content as $content) {
						$view_data['content'] = $content->content;
					}	
				} else if(strcasecmp($type, 'default') == 0 && strcasecmp($data['name'], 'contact_us') == 0) {
					$contents = json_decode($data['content']);

					foreach ($contents->content as $content) {
						$view_data['company_name'] = $content->company_name;
						$view_data['address'] = $content->address;
						$view_data['email'] = $content->email;
						$view_data['contacts'] = implode(' | ', $content->contacts);
					}	
				} else {
					$view_data['content'] =  $data['content'];	
				}
				
			}



			if($type == 'default')
				$this->load->view('Auth/' . $name . '_Admin_Page',$view_data);
			else
				$this->load->view('Auth/Default_Page',$view_data);
		}

		public function removePage(){
			$pages = $this->load->model('Admin/Pages_Model');
			$result = '';

			$result = $pages->removePage($_POST['id'],$this->session->sessionData['user_id']);					

			echo $result;
		}
	}
?>