<?php
	class Support_Model extends Model {

		public function listenForNewInquiry($user_id){
			$query = '
				SELECT 		client_user_session.id,
							client_subject.subject,
				        	client_subject.client_id
				FROM 		client_user_session 
				INNER JOIN 	client_subject
						ON 	client_subject.id = client_user_session.client_subject_id
				WHERE 		client_user_session.user_id = :user_id
				AND			client_user_session.active = 1
				AND 		client_user_session.added in (					
				                SELECT 	MAX(client_user_session.added)
				       	 		FROM 	client_user_session
				        		WHERE 	client_user_session.user_id = :user_id
				        		AND		client_user_session.active = 1
				)
				AND 		client_user_session.open = 0
			';

			$bindParams = array(
				array('bind_param' => ':user_id', 'value' => $user_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);
			if(!empty($result)) {
				$data = array();

				$data['open'] = ':open';

				$whereClause = '
					 id = :id
				';

				$bindParams = array(
					array('bind_param' => ':open', 'value' => 1, 'type' => PDO::PARAM_INT),
					array('bind_param' => ':id', 'value' => $result[0]['id'], 'type' => PDO::PARAM_INT),
				);

				$this->db->update('client_user_session',$data,$whereClause,$bindParams);


				foreach ($result as $value) {
					return $value;
				}
			}

			return 0;
		}

		public function isClientUserSessionActive($postData){
			$query = '
				SELECT 	active
				FROM 	client_user_session
				WHERE 	id = :id
			';

			$bindParams = array(
				array('bind_param' => ':id', 'value' => $postData['cus_id'], 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			foreach ($result as $value) {
				if($value['active'] == 1) {
					$data = array();

					$data['open'] = ':open';

					$whereClause = '	id = :id ';

					$bindParams = array(
						array('bind_param' => ':open', 'value' => 0, 'type' => PDO::PARAM_INT),
						array('bind_param' => ':id', 'value' => $postData['cus_id'], 'type' => PDO::PARAM_INT),
					);

					$this->db->update('client_user_session',$data,$whereClause,$bindParams);
				}
			}
		}
	}
?>