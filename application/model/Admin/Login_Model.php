<?php

	class Login_Model extends Model{
		public function __construct(){
			parent::__construct();
		}

		function display(){
			//print_r($this->db_config);
			$this->db->sampleQuery();
		}

		public function validateAccount($username,$password){
			//$this->db->sampleQuery();
			$query = '
				SELECT 		*
				FROM 		admin_user
				INNER JOIN 	user
						ON 	user.id = admin_user.user_id
				WHERE 		admin_user.username= :username
				AND			admin_user.password= :password
			';

			$bindParams = array(
				array('bind_param' => ':username', 'value' => $username, 'type' => PDO::PARAM_STR),
				array('bind_param' => ':password', 'value' => $password, 'type' => PDO::PARAM_STR),
			);
			$result = $this->db->query($query,$bindParams);
			
			if(empty($result))
				return false;

			return $result;
		}


		public function logLoginStatus($user_id,$login_status,$ancestor_id = null) {

			$data['user_id'] = ':user_id';
			$data['user_login_status_id'] = ':user_login_status_id';
			$data['ip_address'] = ':ip_address';
			$data['browser_type'] = ':browser_type';
			$data['added'] = ':added';
			$data['active'] = ':active';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':user_login_status_id', 'value' => $login_status, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':ip_address', 'value' => $this->get_client_ip(), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':browser_type', 'value' => $_SERVER['HTTP_USER_AGENT'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':active', 'value' => 1, 'type' => PDO::PARAM_INT),
			);

			if($ancestor_id != null) {
				$data['ancestor_id'] = ':ancestor_id';
				$bindParams[] = array('bind_param' => ':ancestor_id', 'value' => $ancestor_id, 'type' => PDO::PARAM_INT);
			}

			$this->db->insert('user_login',$data,$bindParams);

		}

		public function deactivateLoginStatus($user_id){
			//1. Get previous active data
			$data = array();

			$query = '
				SELECT 	id
				FROM 	user_login
				WHERE 	user_id = :user_id
				AND 	active = 1
				AND 	ancestor_id IS NULL
			';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);


			$data = array();

			$data['removed'] = ':removed';
			$data['active'] = ':active';

			$whereClause = '
				 		user_id = :user_id
				 AND 	ip_address = :ip_address
				 AND 	browser_type = :browser_type
				 AND 	active = 1
			';

			$bindParams = array(
				array('bind_param' => ':removed', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':active', 'value' => 0 , 'type' => PDO::PARAM_INT),
				array('bind_param' => ':user_id', 'value' => $user_id , 'type' => PDO::PARAM_INT),
				array('bind_param' => ':ip_address', 'value' => $this->get_client_ip(), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':browser_type', 'value' => $_SERVER['HTTP_USER_AGENT'], 'type' => PDO::PARAM_STR),
			);

			$this->db->update('user_login',$data,$whereClause,$bindParams);


			foreach ($result as $value) {
				return $value['id'];
			}
		}


		public function updateOnlineStatus($user_id,$online_status){

			$query = '
				SELECT 	id
				FROM 	user_online_history
				WHERE 	user_id = :user_id
				AND 	active = 1
				AND 	ancestor_id IS NULL
			';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			if(!empty($result) || count($result[0]) <= 1) {

				$data = array();

				$data['user_online_status_id'] = ':user_online_status_id';

				$where = ' user_id = :user_id ';

				$bindParams = array(
					array('bind_param' => ':user_online_status_id', 'value' => $online_status, 'type' => PDO::PARAM_INT),
					array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				);

				$this->db->update('user_online',$data,$where,$bindParams);
			}
		}


		public function logOnlineStatus($user_id, $online_status, $ancestor_id = null) {
			$data = array();

			$data['user_id'] = ':user_id';
			$data['user_online_status_id'] = ':user_online_status_id';
			$data['ip_address'] = ':ip_address';
			$data['browser_type'] = ':browser_type';
			$data['added'] = ':added';
			$data['active'] = ':active';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':user_online_status_id', 'value' => $online_status, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':ip_address', 'value' => $this->get_client_ip(), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':browser_type', 'value' => $_SERVER['HTTP_USER_AGENT'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':active', 'value' => 1, 'type' => PDO::PARAM_INT),
			);

			if($ancestor_id != null) {
				$data['ancestor_id'] = ':ancestor_id';
				$bindParams[] = array('bind_param' => ':ancestor_id', 'value' => $ancestor_id, 'type' => PDO::PARAM_INT);
			}

			$this->db->insert('user_online_history',$data,$bindParams);
		}


		public function deactivateOnlineStatus($user_id){
			$query = '
				SELECT 	id
				FROM 	user_online_history
				WHERE 	user_id = :user_id
				AND 	active = 1
				AND 	ancestor_id IS NULL
			';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			$data = array();

			$data['removed'] = ':removed';
			$data['active'] = ':active';

			$whereClause = '
				 		user_id = :user_id
				 AND 	ip_address = :ip_address
				 AND 	browser_type = :browser_type
				 AND 	active = 1
			';

			$bindParams = array(
				array('bind_param' => ':removed', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':active', 'value' => 0 , 'type' => PDO::PARAM_INT),
				array('bind_param' => ':user_id', 'value' => $user_id , 'type' => PDO::PARAM_INT),
				array('bind_param' => ':ip_address', 'value' => $this->get_client_ip(), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':browser_type', 'value' => $_SERVER['HTTP_USER_AGENT'], 'type' => PDO::PARAM_STR),
			);

			$this->db->update('user_online_history',$data,$whereClause,$bindParams);


			foreach ($result as $value) {
				return $value['id'];
			}
		}

		function get_client_ip() {
			$ipaddress = '';

			if($_SERVER['REMOTE_ADDR'])
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			if($_SERVER['HTTP_HOST'])
				$ipaddress = $_SERVER['HTTP_HOST'];
			else
				$ipaddress = 'UNKNOWN';

			return $ipaddress;
		}
	}
?>