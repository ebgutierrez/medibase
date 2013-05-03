<?php
	class Representatives_Model extends Model {

		public function isUsernameExists($username,$id = ''){
			$query = '
				SELECT id 
				FROM admin_user
				WHERE username = :username
			';

			$bindParams = array(
				array('bind_param' => ':username', 'value' => $username, 'type' => PDO::PARAM_STR),
			);

			$result = $this->db->query($query,$bindParams);

			if(empty($result))
				return false;
			else {
				foreach ($result as $value) {
					if($id == $value['id'])
						return false;
					else
						return true;
				}
			}

			return true;
		}

		public function addUser($postData,$image){
			$data = array();

			$data['name'] = ':name';
			$data['user_type_id'] = ':user_type';
			$data['added'] = ':added';
			$data['added_by'] = ':user_id';
			$data['image'] = ':image';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $postData['lastname'] . ', ' . $postData['firstname'] . ' ' . $postData['mi'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':user_type', 'value' => 2, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s', time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':user_id', 'value' => $_SESSION['user_id'], 'type' => PDO::PARAM_INT),
				array('bind_param' => ':image', 'value' => $image, 'type' => PDO::PARAM_STR),
			);

			$this->db->insert('user',$data,$bindParams);
			$lastinsertId = $this->db->getLastInsertId();

			$data = array();
			$data['user_id'] = ':user_id';
			$data['username'] = ':username';
			$data['password'] = ':password';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':username', 'value' => $postData['username'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':password', 'value' => $postData['password'], 'type' => PDO::PARAM_STR),
			);

			$this->db->insert('admin_user',$data,$bindParams);

			$data = array();
			
			$data['user_id'] = ':user_id';
			$data['user_online_status_id'] = ':user_online_status_id';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':user_online_status_id', 'value' => 2, 'type' => PDO::PARAM_INT),
			);

			$this->db->insert('user_online',$data,$bindParams);
		}

		public function getOnlineReps(){
			$query = '
				SELECT 		DISTINCT
							user_login.user_id 					,
							user.name AS name					,
							user_online_status.name AS status 	,
							user.image
				FROM 		user_login
				INNER JOIN	user
						ON 	user.id = user_login.user_id
				INNER JOIN 	user_online
						ON 	user_online.user_id = user_login.user_id
				INNER JOIN 	user_online_status
						ON 	user_online_status.id = user_online.user_online_status_id
				WHERE 		user_login.user_login_status_id = 1
				AND 		user_login.active = 1 
				AND 		user.user_type_id <> 1
			';

			return $this->db->query($query);
		}
	}
?>