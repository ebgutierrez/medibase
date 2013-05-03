<?php
	class Pages_Model extends Model{

		public function isPageExist($name,$type = '',$id = ''){

			if(!empty($id)) {
				$query = '';
				switch ($type) {
					case 'd':
					case 'default':
						$query = '
							SELECT 	name,id
							FROM 	page_default
							WHERE 	name = :name

						';
						break;
					case 'g':
					case 'generated':
						$query = '
							SELECT 	name,id
							FROM 	page_generated
							WHERE 	name = :name
							AND 	active = 1
						';
						break;
					default:
						# code...
						break;
				}

				$bindParams = array(
					array("bind_param" => ":name","value" => $name, "type" => PDO::PARAM_STR),
				);

				$result = $this->db->query($query,$bindParams);

				if(empty($result))
					return false;
				else {
					foreach ($result as $value) {
						if($id == $value['id']) {
							return false;
						}
						else
							return true;
					}
				}

			}

			$query = '
				SELECT 	id
				FROM 	page_default
				WHERE 	name = :name

				UNION 

				SELECT 	id
				FROM 	page_generated
				WHERE 	name = :name
				AND 	active = 1
			';

			$bindParams = array(
				array("bind_param" => ":name","value" => $name, "type" => PDO::PARAM_STR),
			);

			$result = $this->db->query($query,$bindParams);

			if(empty($result))
				return false;

			return true;
		}

		public function addPage($data){
			$insertData = array();
			$insertData['name'] = ':name';
			$insertData['text'] = ':text';
			$insertData['content'] = ':content';
			$insertData['added'] = ':added';
			$insertData['added_by'] = ':added_by';
			$insertData['active'] = ':active';

			$bindParams = array(
				array("bind_param" => ":name" , "value" => $data['name'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":text" , "value" => $data['display_text'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":content" , "value" => $data['content'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":added" , "value" => date('Y-m-d h:i:s', time(0)), "type" => PDO::PARAM_STR),
				array("bind_param" => ":added_by" , "value" => $_SESSION['user_id'], "type" => PDO::PARAM_INT),
				array("bind_param" => ":active" , "value" => 1, "type" => PDO::PARAM_INT),
			);

			return $this->db->insert('page_generated',$insertData,$bindParams);
		}

		public function savePage($type,$id,$data){

			$tableName = '';
			$whereClause = '';

			$updateData = array();
			$updateData['name'] = ':name';
			$updateData['text'] = ':text';	
			$updateData['content'] = ':content';		

			$bindParams = array(
				array("bind_param" => ":name" , "value" => $data['name'], "type" => PDO::PARAM_STR),
				array("bind_param" => ":text" , "value" => $data['display_text'], "type" => PDO::PARAM_STR),				
			);


			switch ($type) {
				case 'd':
				case 'default':
					$tableName = 'page_default';

					if($id == 1) {
						$content = array(
							"content" => array(
								array(
									"mission" => $data['mission'],
									"vision" => $data['vision'],
								),
							),
						);

						$bindParams[] = array("bind_param" => ":content" , "value" => json_encode($content), "type" => PDO::PARAM_STR);
					} else if($id == 2) {
						$content = array(
							"content" => array(
								array(
									"content" => $data['content'],
								),
							),
						);

						$bindParams[] = array("bind_param" => ":content" , "value" => json_encode($content), "type" => PDO::PARAM_STR);
					} else if($id == 3) {

						$contacts = explode('|', $data['contacts']);

						foreach ($contacts as &$contact) {
							$contact = trim($contact);
						}

						$content = array(
							"content" => array(
								array(
									"company_name" => $data['company_name'],
									"address" => $data['address'],
									"email" => $data['email'],
									"contacts" => $contacts,
								),
							),
						);

						$bindParams[] = array("bind_param" => ":content" , "value" => json_encode($content), "type" => PDO::PARAM_STR);
					}
					break;
				case 'g':
				case 'generated':
					$tableName = 'page_generated';

					$updateData['updated'] = ':updated';
					$updateData['updated_by'] = ':updated_by';
					$bindParams[] = array("bind_param" => ":updated" , "value" => date('Y-m-d h:i:s', time(0)), "type" => PDO::PARAM_STR);
					$bindParams[] = array("bind_param" => ":updated_by" , "value" => $_SESSION['user_id'], "type" => PDO::PARAM_INT);
					$bindParams[] = array("bind_param" => ":content" , "value" => $data['content'], "type" => PDO::PARAM_STR);
					break;
			}
			$whereClause = ' id = :id';

			$bindParams[] = array("bind_param" => ":id" , "value" => $id, "type" => PDO::PARAM_STR);

			return $this->db->update($tableName,$updateData,$whereClause,$bindParams);
		}

		public function getDefaultPages(){
			$query = '
				SELECT 	id,
						name,
						text, 
						"default" as type
				FROM 	page_default
			';

			return $this->db->query($query);
		}

		public function getGeneratedPages(){
			$query = '
				SELECT 	id,
						name,
						text, 
						"generated" as type
				FROM 	page_generated
				WHERE 	active = 1
			';

			return $this->db->query($query);
		}

		public function getPage($type,$id){
			$tableName = '';

			switch ($type) {
				case 'd':
				case 'default':
					$tableName = 'page_default';
					break;
				case 'g':
				case 'generated':
					$tableName = 'page_generated';
					break;
			}

			$query = '
				SELECT 	id,
						name,
						text,
						content
				FROM 	' . $tableName . '
				WHERE 	id = :id
			';

			$bindParams = array(
				array("bind_param" => ":id", "value" => $id, "type" => PDO::PARAM_INT),
			);

			return $this->db->query($query,$bindParams);
		}

		public function removePage($id,$user_id){

			$data = array(
				'active' => ':status',
				'updated' => ':now',
				'updated_by' => ':user_id',
			);

			$whereClause = ' id = :id';

			$bindParams = array(
				array('bind_param' => ':status', 'value' => '0', 'type' => PDO::PARAM_INT),
				array('bind_param' => ':now', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':user_id', 'value' =>$user_id, 'type' => PDO::PARAM_STR),
				array('bind_param' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT),								
			);

			return $this->db->update('page_generated',$data,$whereClause,$bindParams);
		}
	}
?>