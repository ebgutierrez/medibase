<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Logout extends Controller{
		public function main(){
			if(!isset($this->session->sessionData['user_id']))
				$this->load->controller('Home');
			try {
		        // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one-time mode.
		        NoCSRF::check( 'token', $this->uri->get, true, 60*10, false );

		        $logout_model = $this->load->model('Admin/Login_Model');

		        $ancestor_id = $logout_model->deactivateLoginStatus($this->session->sessionData['user_id']);
		        $logout_model->logLoginStatus($this->session->sessionData['user_id'],2,$ancestor_id);


				$logout_model->updateOnlineStatus($this->session->sessionData['user_id'],2);
				$ancestor_id = $logout_model->deactivateOnlineStatus($this->session->sessionData['user_id']);
				$logout_model->logOnlineStatus($this->session->sessionData['user_id'],2,$ancestor_id);

				$this->session->sessionEnd();
				$this->load->controller('Auth/Login');
			} catch (Exception $e){
				throw new Exception($e->getMessage());
			}
		}
	}
?>