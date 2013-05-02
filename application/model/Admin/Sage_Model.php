<?php
	class Sage_Model extends Model{
		public function isProductExist($product_name,$id = ''){
			$query = '
				SELECT 	id 
				FROM 	sage_products
				WHERE 	name = :name
				AND 	active = 1
			';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $product_name, 'type' => PDO::PARAM_STR),
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

		public function addProduct($postData, $fileData,$user_id){
			$data = array();

			$data['name'] = ':name';
			$data['image'] = ':image';
			$data['price'] = ':price';
			$data['brief_description'] = ':brief_description';
			$data['description'] = ':description';
			$data['added'] = ':added';
			$data['added_by'] = ':added_by';
			$data['active'] = ':active';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $postData['name'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':image', 'value' => $fileData['img']['name'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':price', 'value' => $postData['price'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':brief_description', 'value' => $postData['brief_desc'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':description', 'value' => $postData['desc'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i:s', time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added_by', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':active', 'value' =>1, 'type' => PDO::PARAM_INT),
			);

			$this->db->insert('sage_products',$data,$bindParams);
		}

		public function updateProduct($postData, $prod_id, $user_id, $image_name = ''){
			$data = array();

			$data['name'] = ':name';			
			$data['price'] = ':price';
			$data['brief_description'] = ':brief_description';
			$data['description'] = ':description';
			$data['updated'] = ':updated';
			$data['updated_by'] = ':updated_by';

			$where_clause = '	id=:id';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $postData['name'], 'type' => PDO::PARAM_STR),				
				array('bind_param' => ':price', 'value' => $postData['price'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':brief_description', 'value' => $postData['brief_desc'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':description', 'value' => $postData['desc'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':updated', 'value' => date('Y-m-d h:i:s', time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':updated_by', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':id', 'value' => $prod_id, 'type' => PDO::PARAM_INT),
			);


			if(!empty($image_name)){
				$data['image'] = ':image';

				$bindParams[] = array('bind_param' => ':image', 'value' => $image_name, 'type' => PDO::PARAM_STR);
			}

			$this->db->update('sage_products',$data,$where_clause,$bindParams);
			
		}

		public function removeProduct($id,$user_id) {
			$data = array();

			$data['active'] = ':active';
			$data['removed'] = ':removed';
			$data['removed_by'] = ':removed_by';

			$where_clause = '	id=:id';

			$bindParams = array(
				array('bind_param' => ':active', 'value' => 0, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':removed', 'value' => date('Y-m-d h:i:s', time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':removed_by', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT),
			);

			return $this->db->update('sage_products',$data,$where_clause,$bindParams);
		}

		public function getProducts(){
			$query = '
				SELECT 	id,
						name,
						image,
						price,
						brief_description,
						description
				FROM 	sage_products	
				WHERe 	active = 1			
			';

			return $this->db->query($query);
		}

		public function getProduct($prod_id) {
			$query = '
				SELECT 	id,
						name,
						image,
						price,
						brief_description,
						description
				FROM 	sage_products	
				WHERE 	id = :id	
				AND 	active = 1		
			';

			$bindParams = array(
				array('bind_param' => ':id', 'value' =>$prod_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			foreach ($result as $value) {
				return $value;
			}
		}

		public function isClientExist($clientName,$clientType,$id = ''){
			$query = '
					SELECT 		sage_implementations.id
					FROM 		sage_implementations
					INNER JOIN 	sage_implementations_type
							ON 	sage_implementations_type.id = sage_implementations.type
					WHERE  		sage_implementations.name = :name
					AND  		sage_implementations_type.name = :type
			';

			if(empty($clientType))
				$clientType = 'OTHER';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $clientName, 'type' => PDO::PARAM_STR),
				array('bind_param' => ':type', 'value' => $clientType, 'type' => PDO::PARAM_STR),
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

		public function addClient($postData,$user_id){

			$lastInsertId = 1;

			$query = '
				SELECT 	id
				FROM  	sage_implementations_type
				WHERE 	name = :name
			';

			if(empty($postData['type']))
				$postData['type'] = 'OTHER';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $postData['type'], 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);



			if(empty($result)) {
				if(!empty($postData['type'])) {
					$data = array();

					$data['name'] = ':name';

					$bindParams = array(
						array('bind_param' => ':name', 'value' => strtoupper($postData['type']), 'type' => PDO::PARAM_STR),
					);

					$this->db->insert('sage_implementations_type',$data,$bindParams);
					$lastInsertId = $this->db->getLastInsertId();
				}
			} else {
				$lastInsertId = $result[0]['id'];
			}
			

			$data = array();

			$data['name'] = ':name';
			$data['type'] = ':type';
			$data['location'] = ':location';
			$data['added'] = ':added';
			$data['added_by'] = ':added_by';
			$data['active'] = ':active';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $postData['name'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':type', 'value' => $lastInsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':location', 'value' => $postData['location'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added', 'value' => date('Y-m-d h:i',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':added_by', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':active', 'value' => 1, 'type' => PDO::PARAM_INT),
			);

			$this->db->insert('sage_implementations',$data,$bindParams);
		}

		public function getClients(){
			$retArr = array();

			$query = '
				SELECT 		sage_implementations_type.id as type_id,
							sage_implementations_type.name
				FROM 		sage_implementations_type
				ORDER BY 	sage_implementations_type.name';

			$result = $this->db->query($query);
			

			foreach ($result as $type) {
				$arrCat = array();

				$arrCat['type_id'] = $type['type_id'];
				$arrCat['type_name'] = $type['name'];

				$query = '
					SELECT 		sage_implementations.id as id,
								sage_implementations.name,
								sage_implementations.location
					FROM 		sage_implementations
					WHERE 		sage_implementations.type = :type_id
					AND 		sage_implementations.active = 1
					ORDER BY  	sage_implementations.name
				';

				$bindParams = array(
					array('bind_param' => ':type_id', 'value' => $type['type_id'], 'type' => PDO::PARAM_INT),
				);

				$catResult = $this->db->query($query,$bindParams);

				$arrCat['clients'] = array();

				foreach ($catResult as $client) {
					$subCat = array();

					$subCat['id'] = $client['id'];
					$subCat['name'] = $client['name'];
					$subCat['location'] = $client['location'];

					$arrCat['clients'][] = $subCat;
				}

				$retArr[] = $arrCat;
			}

			
			return $retArr;
		}

		public function getClientsOnly(){
			$query = '
				SELECT 		sage_implementations.id as id,
							sage_implementations.name,
							sage_implementations.location
				FROM 		sage_implementations
				WHERE 		sage_implementations.active = 1
				ORDER BY  	sage_implementations.name
			';

			return $this->db->query($query);
		}

		public function getClient($id){
			$query = '
				SELECT 		sage_implementations.name,
							sage_implementations_type.name as type,
							sage_implementations_type.id,
				            sage_implementations.location
				FROM 		sage_implementations
				INNER JOIN 	sage_implementations_type
				ON 			sage_implementations_type.id = sage_implementations.type
				WHERE  		sage_implementations.id = :id
			';

			$bindParams = array(
				array('bind_param' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			foreach ($result as $value) {
				return $value;
			}
		}

		public function updateClient($postData,$user_id,$id){
			$lastInsertId = 1;

			//1 get type id
			$query = '
				SELECT 	name
				FROM 	sage_implementations_type
				WHERE 	id = :id
			';

			$bindParams = array(
				array('bind_param' => ':id', 'value' => $postData['type_id'], 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			foreach ($result as $value) {
				if(strcasecmp($value['name'], strtoupper($postData['type']))) { //type is changed
					//check if type already exist
					$query = '
						SELECT 	id
						FROM  	sage_implementations_type
						WHERE 	name = :name
					';

					$bindParams = array(
						array('bind_param' => ':name', 'value' => strtoupper($postData['type']), 'type' => PDO::PARAM_INT),
					);

					$result2 = $this->db->query($query,$bindParams);

					if(empty($result2)) {
						if(!empty($postData['type'])) {
							$data = array();

							$data['name'] = ':name';

							$bindParams = array(
								array('bind_param' => ':name', 'value' => strtoupper($postData['type']), 'type' => PDO::PARAM_STR),
							);

							$this->db->insert('sage_implementations_type',$data,$bindParams);
							$lastInsertId = $this->db->getLastInsertId();
						}
					} else {
						$lastInsertId = $result2[0]['id'];
					}
				} else {
					$lastInsertId = $postData['type_id'];
				}
			}

			
			

			$data = array();

			$data['name'] = ':name';
			$data['type'] = ':type';
			$data['location'] = ':location';
			$data['updated'] = ':updated';
			$data['updated_by'] = ':updated_by';

			$whereClause = ' id = :id ';

			$bindParams = array(
				array('bind_param' => ':name', 'value' => $postData['name'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':type', 'value' => $lastInsertId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':location', 'value' => $postData['location'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':updated', 'value' => date('Y-m-d h:i',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':updated_by', 'value' => $user_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT),
			);



			$this->db->update('sage_implementations',$data,$whereClause,$bindParams);
		}
	}
?>