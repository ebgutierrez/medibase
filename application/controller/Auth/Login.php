<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Login extends Controller{
		public function main(){

			if(isset($this->session->sessionData['user_id'])){
				switch ($this->session->sessionData['type']) {
					case 1:
						$this->load->controller('Auth/Admin');
						break;
					case 2:
						$this->load->controller('Auth/Support');
						break;
					default:
						# code...
						break;
				}
				
			}
			

			$view_data = array(
				'title'=>'JCA Admin Panel',
				'login_title'=>'JCA Login Panel',
			);

			$login_model = $this->load->model('Admin/Login_Model');					
			

			$validateFields = array(
				array('name' => 'username', 'label' => 'Username', 'validation' => 'required'),
				array('name' => 'password', 'label' => 'Password', 'validation' => 'required'),
			);
			if($this->form->validate($validateFields)){
				try{
					NoCSRF::check( 'token', $this->form->post, true, 60*10, false);

					$loginResult = $login_model->validateAccount($_POST['username'],$_POST['password']);

					if(!$loginResult) {
						$this->form->errors = array('Account does not exist. Invalid Username/Password');
					} else {
						$sessionArray = array();
						foreach ($loginResult as $value) {
							$sessionArray['user_id'] = $value['user_id'];
							$sessionArray['type'] = $value['user_type_id'];
						}

						$this->session->sessionData = $sessionArray;

						$login_model->logLoginStatus($sessionArray['user_id'],1);
						$login_model->updateOnlineStatus($sessionArray['user_id'],1);
						$login_model->logOnlineStatus($sessionArray['user_id'],1);

						switch ($sessionArray['type']) {
							case 1:
								$this->load->controller('Auth/Admin');
								break;
							case 2:
								$this->load->controller('Auth/Support');
								break;
							default:
								# code...
								break;
						}
						
					}
				} catch(Exception $e) {
					$this->form->errors = array("CSRF Token checking failed.");
				}
			}						
				

			$this->load->view('Auth/Login',$view_data);	

		}

	}
?>