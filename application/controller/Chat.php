<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Chat extends Controller {
		public function getOnline(){
			$this->reps = $this->load->model('Admin/Representatives_Model');
					
			$view_data['online_reps'] = $this->reps->getOnlineReps();
			$view_data['support_clicked'] = $this->form->post['supportClicked'];
			echo $this->load->view('Online',$view_data,true);
		}

		public function inquire() {
			
			$view_data = array();

			$view_data['uid'] = $this->uri->get['u_id'];

			$validateFields = array(
				array('name' => 'lastname', 'label' => 'Last Name', 'validation' => 'required'),
				array('name' => 'firstname', 'label' => 'First Name', 'validation' => 'required'),
				array('name' => 'email', 'label' => 'Email', 'validation' => 'required|filter=email'),
				array('name' => 'subject', 'label' => 'Subject', 'validation' => 'required'),
			);

			if($this->form->validate($validateFields)) {
				$inquiry = $this->load->model('Inquiry_Model');
				$retVal =  $inquiry->addClient($this->form->post);

				$view_data['client_id'] = $retVal['client_id'];
				$view_data['client_user_session_id'] = $retVal['client_user_session_id'];
				$view_data['subject'] = $this->form->post['subject'];
				$this->session->sessionData = array('cus_id' => $retVal['client_user_session_id']);
				$this->load->controller('Chat/startChat?uid=' . $view_data['uid'] . '&cid=' . $view_data['client_id'] . '&cusid=' . $view_data['client_user_session_id'] . '&sbj=' . urlencode($view_data['subject']));
			} else {
				$this->load->view('Chat_Inquiry',$view_data);
			}			
		}

		public function startChat(){
			$view_data = array(
				'uid' => $this->uri->get['uid'],
				'client_id' => $this->uri->get['cid'],
				'client_user_session_id' => $this->uri->get['cusid'],
				'subject' => urldecode($this->uri->get['sbj']),
			);

			
			$this->load->view('Chat_Box_Inquiry',$view_data);
		}

		public function deactivateClientUserSession(){
			$cus_id = null;
			if(array_key_exists('cus_id', $this->session->sessionData)){
				$cus_id = ($this->session->sessionData['cus_id'] + 0);

				$this->session->sessionUnset('cus_id');
			}

			//echo $cus_id;
			$inquiry = $this->load->model('Inquiry_Model');
			echo $inquiry->deactivateClientUserSession($cus_id);
		}

		public function sendChatMessage() {
			$inquiry = $this->load->model('Inquiry_Model');
			echo $inquiry->sendChatMessage($this->form->post);
		}

		public function getChatMessage(){
			$inquiry = $this->load->model('Inquiry_Model');

			$result = array();

			//check if session is active
			$isActive = $inquiry->isClientUserSessionActive($this->form->post['client_user_session_id']);

			if($isActive) {
				$result['active'] = 1;
				$messages =  $inquiry->getChatMessage($this->form->post);

				foreach ($messages as &$message) {
					$message['message_from'] = $inquiry->getName($message['from_type'],$message['message_from']);
				}

				$view_data['messages'] = $messages;
				$result['message'] = $this->load->view('Chat_Messages',$view_data,true);
			}
			else 
				$result['active'] = 0;

			
			header("Content-Type: application/json");
			echo json_encode($result);
		}

		public function addWindow(){
			$this->session->sessionData = array('window' => $this->form->post['window']);

			echo $this->session->sessionData['window'];
		}
	}
?>