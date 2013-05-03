<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Admin extends Controller{

		private $services;
		private $pages;
		private $reps;

		public function main(){
			

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');
			
			$viewData = array('title'=>'JCA Admin Panel');
			

			$this->reps = $this->load->model('Admin/Representatives_Model');

			$viewData['online_reps'] = $this->reps->getOnlineReps();
			$this->load->view('Auth/Admin',$viewData);
			
		}
		

		

		public function removeSelected(){
			$this->services = $this->load->model('Admin/Services_Model');
			$result = '';


			if(empty($this->form->post['subcat_id']))
				$result = $this->services->removeCategory($this->form->post['cat_id']);	
			else
				$result = $this->services->removeSubcategory($this->form->post['subcat_id']);	

			echo $result;
		}

		public function representatives(){

			$action = 'add';
			$id = null;

			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');


			$this->reps = $this->load->model('Admin/Representatives_Model');

			$view_data = array(
				'title' => 'JCA Services',
			);

			if(!count($this->uri->get)) {
				$action = 'add';
			} else {
				if(isset($this->uri->get['actn']) && strlen(trim($this->uri->get['actn']))) {
					$action = $this->uri->get['actn'];
				}
			}

			$view_data['action'] = $action;
			$view_data['id'] = $id;


			switch ($action) {
				case 'add':
					$view_data['submit_value'] = 'Add';
					break;
				case 'edit':
					$view_data['submit_value'] = 'Save';
					break;
				default:
					# code...
					break;
			}

			$validateFields = array(
				array('name' => 'lastname', 'label' => 'Last Name', 'validation' => 'required'),
				array('name' => 'firstname', 'label' => 'First Name', 'validation' => 'required'),
				array('name' => 'username', 'label' => 'Username', 'validation' => 'required'),
			);


			if($this->form->validate($validateFields)) {
				if($this->reps->isUsernameExists($this->form->post['username'], $id)) {
						$this->form->errors = array("Username already exist");
				} else {

					if(strlen(trim($this->form->file["user_image"]["name"])) > 0){
						if($this->form->validateFile('user_image','user_' . date('Ymdhis',time()) . '_' . $this->form->file["user_image"]["name"])) {
							chmod($_SERVER['image'], 0777);

					      	move_uploaded_file(
					      		$this->form->file["user_image"]["tmp_name"],
					      		$_SERVER['image'] ."/" . $this->form->file["user_image"]["name"]
					      	);
						}
					}

			      	switch ($action) {
			      		case 'add':
			      			$this->reps->addUser($this->form->post,$this->form->file["user_image"]["name"]);
			      			break;				      		
			      		case 'edit':
			      			$this->reps->editUser($id,$this->form->post);
			      			break;
			      	}
				}
			}

			$this->load->view('Auth/Representatives',$view_data);
	
		}


		public function pages(){

			$action = '';
			$t = '';
			$id = '';


			if(!isset($this->session->sessionData['user_id']) || $this->session->sessionData['type'] != 1)
				$this->load->controller('Auth/Login');


			$view_data = array(
				'title' => 'JCA Pages',
				't' => $t,
				'id' => $id,
			);

			$this->pages = $this->load->model('Admin/Pages_Model');
		
			if(!count($this->uri->get)) {
				$view_data['gen_data'] = 'Add Page';
				$view_data['action'] = 'Add';	
				$view_data['actn'] = 'add';				
				$view_data['readonly'] = "";	
				$action = 'add';			
			} else {
				if(isset($this->uri->get['actn']) && strlen(trim($this->uri->get['actn']))) {
					$action = $this->uri->get['actn'];
				}


				switch ($action) {
					case 'add':
						$view_data['gen_data'] = 'Add Page';
						$view_data['action'] = 'Add';
						$view_data['actn'] = 'add';
						$view_data['readonly'] = "";
						break;
					case 'edit':
						$view_data['gen_data'] = 'Edit Page';
						$view_data['action'] = 'Save';
						$view_data['actn'] = 'edit';

						if(isset($this->uri->get['t']) && strlen(trim($this->uri->get['t']))) {
							$view_data['t'] = $this->uri->get['t'];
							$t = $this->uri->get['t'];

							if(strcasecmp($t, 'g') == 0){
								$view_data['remove'] = "Remove";
								$view_data['readonly'] = "";
							} else {
								$view_data['readonly'] = "readonly";
							}
						}

						if(isset($this->uri->get['id']) && strlen(trim($this->uri->get['id']))) {
							$view_data['id'] = $this->uri->get['id'];
							$id = $this->uri->get['id'];
						}

						$pageData = $this->pages->getPage($t,$id);

						foreach ($pageData as $data) {
							$view_data['name'] =  $data['name'];
							$view_data['display_text'] =  $data['text'];

							if(strcasecmp($t, 'd') == 0 && strcasecmp($data['name'], 'home') == 0) {
								$contents = json_decode($data['content']);

								foreach ($contents->content as $content) {
									$view_data['mission'] = $content->mission;
									$view_data['vision'] = $content->vision;
								}								
							} else if(strcasecmp($t, 'd') == 0 && strcasecmp($data['name'], 'about_us') == 0) {
								$contents = json_decode($data['content']);

								foreach ($contents->content as $content) {
									$view_data['content'] = $content->content;
								}	
							}else {
								$view_data['content'] =  $data['content'];	
							}
							
						}
						break;
					default:
						$view_data['gen_data'] = 'Add Page';
						$view_data['action'] = 'Add';
						break;
				}
			}

			$validateFields = array(
				array('name' => 'name', 'label' => 'Name', 'validation' => 'required'),
				array('name' => 'display_text', 'label' => 'Display Text', 'validation' => 'required'),				
			);

			if($t == 'd' && $id == 1) {
				$validateFields[] = array('name' => 'mission', 'label' => 'Mission', 'validation' => 'required');
				$validateFields[] = array('name' => 'vision', 'label' => 'Vision', 'validation' => 'required');
			} else if ($t == 'd' && $id == 2) {
				$validateFields[] = array('name' => 'content', 'label' => 'Content', 'validation' => 'required');
			} else if ($t == 'g') {
				$validateFields[] = array('name' => 'content', 'label' => 'Content', 'validation' => 'required');
			}



			if($this->form->validate($validateFields)) {				
				if(!$this->pages->isPageExist($this->form->post['name'],$t,$id)) {
					switch ($action) {
						case 'add':
							$view_data['success'] = $this->pages->addPage($this->form->post);
							break;
						case 'edit':
							$view_data['success'] = $this->pages->savePage($t,$id,$this->form->post);

							$pageData = $this->pages->getPage($t,$id);

							foreach ($pageData as $data) {
								$view_data['name'] =  $data['name'];
								$view_data['display_text'] =  $data['text'];

								if( strcasecmp($t, 'd') == 0 && strcasecmp($data['name'], 'home') == 0) {
									$contents = json_decode($data['content']);

									foreach ($contents->content as $content) {
										$view_data['mission'] = $content->mission;
										$view_data['vision'] = $content->vision;
									}								
								}else if( strcasecmp($t, 'd') == 0 && strcasecmp($data['name'], 'about_us') == 0) {
									$contents = json_decode($data['content']);

									foreach ($contents->content as $content) {
										$view_data['content'] = $content->content;
									}								
								} else {
									$view_data['content'] =  $data['content'];	
								}

								
							}
							break;
						default:
							# code...
							break;
					}					
				}
			}
			
			$view_data['default_pages'] = $this->pages->getDefaultPages();
			$view_data['generated_pages'] = $this->pages->getGeneratedPages();

			$this->load->view('Auth/Pages',$view_data);			
		}

		public function removePage(){
			$this->pages = $this->load->model('Admin/Pages_Model');
			$result = '';

			$result = $this->pages->removePage($_POST['id']);					

			echo $result;
		}
	}
?>