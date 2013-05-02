<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Support extends Controller{
		public function main(){ 
			if(!isset($this->session->sessionData['user_id']))
				$this->load->controller('Auth/Login');

			$this->load->view('Representatives');
		}

		public function listenForNewInquiry(){
			$retVal = 0;
			$support = $this->load->model('Admin/Support_Model');
			$result =  $support->listenForNewInquiry($this->session->sessionData['user_id']);

			if($result != 0){
				$retVal = 'cus_id=' . $result['id'];
				$retVal .= '&sbj=' . urlencode($result['subject']);
				$retVal .= '&c_id=' . $result['client_id'];
			}

			echo $retVal;
		}

		public function startChat(){
			$view_data = array();

			$view_data['client_user_session_id'] = $this->uri->get['cus_id'];
			$view_data['subject'] = urldecode($this->uri->get['sbj']);
			$view_data['client_id'] = $this->uri->get['c_id'];
			
			$view_data['user_id'] = $this->session->sessionData['user_id'];

			$this->load->view('Auth/Support_Chat_Box',$view_data);
		}

		public function isClientUserSessionActive(){
			$support = $this->load->model('Admin/Support_Model');
			$support->isClientUserSessionActive($this->form->post);
		}
	}
?>