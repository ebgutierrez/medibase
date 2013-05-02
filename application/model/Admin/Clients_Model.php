<?php
	class Clients_Model extends Model{
		public function getClients(){
			$query = '
				SELECT 	id,
						company_name,
						address,
						contact_person,
						position,
						contact_number
				FROM 	jca_clients
				WHERE 	active = 1
				ORDER BY company_name
			';

			$results = $this->db->query($query);

			return $results;
		}

		public function getClient($id){
			$query = '
				SELECT 	company_name,
						address,
						contact_person,
						position,
						contact_number
				FROM 	jca_clients
				WHERE 	active = 1
				AND 	id = :id
			';

			$bindParams = array(
				array("bind_param" => ":id", "value" => $id, "type" => PDO::PARAM_INT),
			);

			$results = $this->db->query($query,$bindParams);

			foreach ($results as $result) {
				return $result;
			}

			
		}

		public function isClientExist($company_name,$id){
			$query = '
				SELECT 	id
				FROM 	jca_clients
				WHERE 	active=1
				AND 	company_name = :company_name
			';

			$bindParams = array(
				array("bind_param" => ":company_name", "value" => $company_name, "type" => PDO::PARAM_STR),
			);

			$results = $this->db->query($query,$bindParams);

			if(empty($results))
				return false;
			else {
				foreach ($results as $value) {
					if($id == $value['id'])
						return false;
					else
						return true;
				}
			}

			return true;
		}

		public function addClient($postData, $user_id) {
			$data = array();

			$data['company_name'] = ":company_name";
			$data['address'] = ":address";
			$data['contact_person'] = ":contact_person";
			$data['position'] = ":position";
			$data['contact_number'] = ":contact_number";
			$data['added'] = ":added";
			$data['added_by'] = ":added_by";
			$data['active'] = ":active";

			$bindParams = array(
				array("bind_param" => ":company_name", "value" => $postData['company_name'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":address", "value" => $postData['address'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":contact_person", "value" => $postData['contact_person'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":position", "value" => $postData['position'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":contact_number", "value" => $postData['contact_number'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":added", "value" => date('Y-m-d h:i:s',time()), "type" => PDO::PARAM_STR),
				array("bind_param" => ":added_by", "value" => $user_id, "type" => PDO::PARAM_INT),
				array("bind_param" => ":active", "value" => 1, "type" => PDO::PARAM_INT),
			);

			$this->db->insert('jca_clients',$data,$bindParams);
		}

		public function updateClient($postData, $user_id, $id){
			$data = array();

			$data['company_name'] = ":company_name";
			$data['address'] = ":address";
			$data['contact_person'] = ":contact_person";
			$data['position'] = ":position";
			$data['contact_number'] = ":contact_number";
			$data['updated'] = ":updated";
			$data['updated_by'] = ":updated_by";

			$whereClause = ' id = :id';

			$bindParams = array(
				array("bind_param" => ":company_name", "value" => $postData['company_name'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":address", "value" => $postData['address'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":contact_person", "value" => $postData['contact_person'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":position", "value" => $postData['position'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":contact_number", "value" => $postData['contact_number'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":updated", "value" => date('Y-m-d h:i:s',time()), "type" => PDO::PARAM_STR),
				array("bind_param" => ":updated_by", "value" => $user_id, "type" => PDO::PARAM_INT),
				array("bind_param" => ":id", "value" => $id, "type" => PDO::PARAM_INT),
			);



			$this->db->update('jca_clients',$data,$whereClause, $bindParams);
		}
	}
?>