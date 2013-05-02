<?php
	class Inquiry_Model extends Model{

		function addClient($postData){
			$data = array();
			$retValArray = array();

			//1. add to client table		
			$data['firstname'] = ':firstname';
			$data['lastname'] = ':lastname';
			$data['email'] = ':email';
			$data['added'] = ':added';

			$bindParams = array(
				array('bind_param' => ':firstname', 'value' => $postData['firstname'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':lastname', 'value' => $postData['lastname'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':email', 'value' => $postData['email'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
			);

			$this->db->insert('client',$data,$bindParams);
			$lastinsertId = $this->db->getLastInsertId();

			$retValArray['client_id'] = $lastinsertId;

			//2. add to client_subject
			$data = array();

			$data['subject'] = ':subject';
			$data['client_id'] = ':client_id';
			$data['inquiry_type_id'] = ':inquiry_type_id';

			$bindParams = array(
				array('bind_param' => ':subject', 'value' => $postData['subject'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':client_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':inquiry_type_id', 'value' => $postData['inquiry_type'], 'type' => PDO::PARAM_INT),
			);

			$this->db->insert('client_subject',$data,$bindParams);
			$lastinsertId = $this->db->getLastInsertId();

			//3. add to client_user_session
			$data = array();

			$data['client_subject_id'] = ':client_subject_id';
			$data['user_id'] = ':user_id';
			$data['added'] = ':added';
			$data['active'] = ':active';			

			$bindParams = array(
				array('bind_param' => ':client_subject_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':user_id', 'value' => $postData['uid'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':active', 'value' => 1, 'type' => PDO::PARAM_INT),				
			);

			$this->db->insert('client_user_session',$data,$bindParams);
			$lastinsertId = $this->db->getLastInsertId();
			$retValArray['client_user_session_id'] = $lastinsertId;

			return $retValArray;
		}

		function addClientEmailProductInquiry($postData){
			$data = array();
			$retValArray = array();

			//1. add to client table		
			$data['firstname'] = ':firstname';
			$data['lastname'] = ':lastname';
			$data['address'] = ':address';
			$data['email'] = ':email';
			$data['phone'] = ':phone';
			$data['company'] = ':company';
			$data['added'] = ':added';

			$bindParams = array(
				array('bind_param' => ':firstname', 'value' => $postData['firstname'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':lastname', 'value' => $postData['lastname'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':address', 'value' => $postData['address'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':email', 'value' => $postData['email'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':phone', 'value' => $postData['phone'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':company', 'value' => $postData['company'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
			);

			$this->db->insert('client',$data,$bindParams);
			$lastinsertId = $this->db->getLastInsertId();

			$retValArray['client_id'] = $lastinsertId;

			//2. add to client_subject
			$data = array();

			$data['subject'] = ':subject';
			$data['client_id'] = ':client_id';
			$data['inquiry_type_id'] = ':inquiry_type_id';

			$bindParams = array(
				array('bind_param' => ':subject', 'value' => $postData['subject'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':client_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':inquiry_type_id', 'value' => 2, 'type' => PDO::PARAM_INT),
			);

			$this->db->insert('client_subject',$data,$bindParams);

			$lastinsertId = $this->db->getLastInsertId();

			$data = array();

			$data['client_subject_id'] = ':client_subject_id';
			$data['message'] = ':message';
			$data['added'] = ':added';

			$bindParams = array(
				array('bind_param' => ':client_subject_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':message', 'value' => $postData['message'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
			);

			$this->db->insert('client_email_message',$data,$bindParams);
		}

		function display(){
			//print_r($this->db_config);
			$this->db->sampleQuery();
		}

		function sendChatMessage($postData){
			$data = array();

			$data['client_user_session_id'] = ':client_user_session_id';
			$data['message_from'] = ':message_from';
			$data['message_to'] = ':message_to';
			$data['message'] = ':message';
			$data['added'] = ':added';
			$data['from_type'] = ':from_type';

			$bindParams = array(
				array('bind_param' => ':client_user_session_id', 'value' => $postData['client_user_session_id'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':message_from', 'value' => $postData['from'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':message_to', 'value' =>$postData['to'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':message', 'value' =>$postData['message'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':from_type', 'value' =>$postData['type_id'], 'type' => PDO::PARAM_INT),
			);

			return $this->db->insert('client_chat',$data,$bindParams);
		}

		function getChatMessage($postData){


			$query = '
				SELECT 	client_chat.message,
				        client_chat.added,
				        client_chat.message_from,
				        client_chat.message_to,
				        client_chat.from_type
				FROM 	client_chat
				WHERE	client_chat.client_user_session_id = :client_user_session_id
				AND			(
				                        client_chat.message_from = :message_from
				                AND 	client_chat.message_to = :message_to
				            )	OR
				            (
				            		client_chat.message_from = :message_to
				                AND 	client_chat.message_to = :message_from            
				            )
				ORDER BY client_chat.added
			';

			$bindParams = array(
				array('bind_param' => ':client_user_session_id', 'value' => $postData['client_user_session_id'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':message_from', 'value' => $postData['from'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':message_to', 'value' =>$postData['to'], 'type' => PDO::PARAM_INT),
			);

			return $this->db->query($query,$bindParams);
		}

		function getName($from_type,$id){
			$query = '';
			switch ($from_type) {
				case 1:
					$query = '
						SELECT 	lastname as name
						FROM client
						WHERE id=:id
					';
					break;
				case 2:
					$query = '
						SELECT 	name
						FROM user
						WHERE id=:id
					';
				break;
			}

			$bindParams = array(
				array('bind_param' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			foreach ($result as $value) {
				switch ($from_type) {
					case 1:
						return '<font color="blue">' . $value['name'] . '</font>';
						break;
					case 2:
						return '<font color="red">' . $value['name'] . '</font>';
						break;
						
				}
				
			}
		}

		function deactivateClientUserSession($cus_id){
			$data['active'] = ':active';
			$whereClause = '	id = :id';

			$bindParams = array(
				array('bind_param' => ':active', 'value' => 0, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':id', 'value' => $cus_id, 'type' => PDO::PARAM_INT),
			);

			return $this->db->update('client_user_session',$data,$whereClause,$bindParams);
		}

		function isClientUserSessionActive($client_user_session_id){
			$query = '
				SELECT 	active
				FROM 	client_user_session
				WHERE 	id = :id
			';

			$bindParams = array(
				array('bind_param' => ':id', 'value' => $client_user_session_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			foreach ($result as $value) {
				if($value['active'] == 1) {
					return 1;
				}
			}

			return 0;
		}

	}
?>