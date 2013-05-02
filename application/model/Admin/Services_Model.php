<?php
	class Services_Model extends Model{

		public function getAllServices(){
			$query = '
				SELECT 		subcategory.id,
							subcategory.name,
							subcategory.image,
							subcategory.description,
							category_subcategory.category_id
				FROM 		subcategory
				INNER JOIN 	category_subcategory
						ON 	category_subcategory.subcategory_id = subcategory.id
				WHERE 		subcategory.active = 1;
			';

			return $this->db->query($query);
		}

		public function getService($cat_id,$subcat_id){
			$query = '
				SELECT 		subcategory.id,
							subcategory.name,
							subcategory.image,
							subcategory.description,
							category_subcategory.category_id
				FROM 		subcategory
				INNER JOIN 	category_subcategory
						ON 	category_subcategory.subcategory_id = subcategory.id
				WHERE 		subcategory.active = 1
				AND 		category_subcategory.category_id = :cat_id
				AND 		category_subcategory.subcategory_id = :subcat_id
			';

			$bindParams = array(
				array("bind_param"=>":cat_id","value"=>$cat_id,"type"=>PDO::PARAM_INT),
				array("bind_param"=>":subcat_id","value"=>$subcat_id,"type"=>PDO::PARAM_INT),
			);

			return $this->db->query($query,$bindParams);
		}

		public function getServices(){
			$retArr = array();

			$query = '
				SELECT 	category.id as cat_id,
						category.name
				FROM 	category WHERE active = 1';

			$result = $this->db->query($query);
			

			foreach ($result as $category) {
				$arrCat = array();

				$arrCat['cat_id'] = $category['cat_id'];
				$arrCat['cat_name'] = $category['name'];

				$query = '
					SELECT 		subcategory.id as subcat_id,
								subcategory.name
					FROM 		category_subcategory
					INNER JOIN 	subcategory
							ON 	subcategory.id = category_subcategory.subcategory_id
					WHERE 		category_subcategory.category_id = :cat_id
					AND 		subcategory.active = 1
				';

				$bindParams = array(
					array('bind_param' => ':cat_id', 'value' => $category['cat_id'], 'type' => PDO::PARAM_INT),
				);

				$catResult = $this->db->query($query,$bindParams);

				$arrCat['subcat'] = array();

				foreach ($catResult as $subcat) {
					$subCat = array();

					$subCat['subcat_id'] = $subcat['subcat_id'];
					$subCat['subcat_name'] = $subcat['name'];

					$arrCat['subcat'][] = $subCat;
				}

				$retArr[] = $arrCat;
			}

			
			return $retArr;
		}

		public function isCategoryExist($catName,$id = '') {
			$query = '
				SELECT *
				FROM category
				WHERE name=:catName
				AND active = 1
			';
			$bindParams = array(
				array('bind_param' => ':catName', 'value' => $catName, 'type' => PDO::PARAM_STR),
			);

			$result = $this->db->query($query,$bindParams);

			if(empty($result)){

				return false;

			} else {

				foreach ($result as $value) {
					if($id == $value['id'])
						return false;
					else
						return true;
				}
			}

			return true;
		}

		public function isSubcategoryExist($subcat_name,$cat_id,$id = ''){
			$query = '
						SELECT 		* 
						FROM 		category_subcategory
						INNER JOIN	subcategory	
								ON	subcategory.id = category_subcategory.subcategory_id
						WHERE		category_subcategory.category_id = :cat_id
						AND			subcategory.name = :subcat_name
						AND 		subcategory.active = 1
			';

			$bindParams = array(
				array('bind_param' => ':cat_id', 'value' => $cat_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':subcat_name', 'value' => $subcat_name, 'type' => PDO::PARAM_STR),
			);

			$result = $this->db->query($query,$bindParams);


			if(empty($result)){

				return false;

			} else {

				foreach ($result as $value) {
					if($id == $value['id'])
						return false;
					else
						return true;
				}
			}

			return true;
		}

		public function addSubcategory($postData,$fileData,$catId,$added_by){

			$data = array();

			$data['added'] = ':current_date';
			$data['added_by'] = ':added_by';
			$data['name'] = ':subcat_name';
			$data['description'] = ':subcat_desc';
			$data['image'] = ':subcat_image';

			$bindParams = array(
				array('bind_param'=>':current_date','value'=>date('Y-m-d h:i:s',time()),'type' => PDO::PARAM_STR),
				array('bind_param'=>':added_by','value'=>$added_by,'type' => PDO::PARAM_INT),
				array('bind_param'=>':subcat_name','value'=>$postData['subcat_name'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':subcat_desc','value'=>$postData['subcat_desc'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':subcat_image','value'=>$fileData["subcat_image"]["name"],'type' => PDO::PARAM_STR)
			);


			$result = $this->db->insert('subcategory',$data,$bindParams);
			$lastinsertId = $this->db->getLastInsertId();
			
			$data = array();
			$data['category_id'] = ':cat_id';
			$data['subcategory_id'] = ':subcat_id';

			$bindParams = array(
				array('bind_param' => ':cat_id', 'value' => $catId, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':subcat_id', 'value' => $lastinsertId, 'type' => PDO::PARAM_STR),
			);

			return $this->db->insert('category_subcategory',$data,$bindParams);
		}

		public function addCategory($postData,$added_by){

			$data = array();

			$data['name'] = ':cat_name';
			$data['description'] = ':cat_desc';
			$data['added'] = ':current_date';
			$data['added_by'] = ':added_by';
			

			$bindParams = array(
				array('bind_param'=>':cat_name','value'=>$postData['cat_name'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':cat_desc','value'=>$postData['cat_desc'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':current_date','value'=>date('Y-m-d h:i:s',time()),'type' => PDO::PARAM_STR),
				array('bind_param'=>':added_by','value'=>$added_by,'type' => PDO::PARAM_INT),				
			);
			return $this->db->insert('category',$data,$bindParams);
		}

		public function updateCategory($postData,$cat_id,$user_id){
			$data = array();

			$data['name'] = ':cat_name';
			$data['description'] = ':cat_desc';
			$data['updated'] = ':updated';
			$data['updated_by'] = ':updated_by';
			
			$whereClause = ' id = :cat_id';

			$bindParams = array(
				array('bind_param'=>':cat_name','value'=>$postData['cat_name'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':cat_desc','value'=>$postData['cat_desc'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':updated','value'=>date('Y-m-d h:i:s',time()),'type' => PDO::PARAM_STR),
				array('bind_param'=>':updated_by','value'=>$user_id,'type' => PDO::PARAM_INT),	
				array('bind_param'=>':cat_id','value'=>$cat_id,'type' => PDO::PARAM_INT),				
			);

			return $this->db->update('category',$data,$whereClause,$bindParams);
		}

		public function updateSubcategory($postData,$cat_id,$subcat_id,$user_id,$image_name = ''){
			$data = array();

			$data['updated'] = ':updated';
			$data['updated_by'] = ':updated_by';
			$data['name'] = ':subcat_name';
			$data['description'] = ':subcat_desc';

			if(!empty($image_name))
				$data['image'] = ':subcat_image';

			$whereClause = 'id = :subcat_id';

			$bindParams = array(
				array('bind_param'=>':updated','value'=>date('Y-m-d h:i:s',time()),'type' => PDO::PARAM_STR),
				array('bind_param'=>':updated_by','value'=>$user_id,'type' => PDO::PARAM_INT),
				array('bind_param'=>':subcat_name','value'=>$postData['subcat_name'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':subcat_desc','value'=>$postData['subcat_desc'],'type' => PDO::PARAM_STR),
				array('bind_param'=>':subcat_id','value'=>$subcat_id,'type' => PDO::PARAM_INT),
			);

			if(!empty($image_name))
				$bindParams[] = array('bind_param'=>':subcat_image','value'=>$image_name,'type' => PDO::PARAM_STR);


			$this->db->update('subcategory',$data,$whereClause,$bindParams);

			$data = array(
				'category_id' => ':cat_id',
			);

			$whereClause = ' subcategory_id = :subcat_id';


			$bindParams = array(
				array('bind_param' => ':cat_id', 'value' => $cat_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':subcat_id', 'value' => $subcat_id, 'type' => PDO::PARAM_INT),
			);

			return $this->db->update('category_subcategory',$data,$whereClause,$bindParams);
		}

		public function getCategories(){
			$whereClause = ' active = 1';
			$result = $this->db->selectAll('category',$whereClause);
			return $result;
		}

		public function getCategory($cat_id){
			$query = '
				SELECT *
				FROM category
				WHERE id = :cat_id
			';
			$bindParams = array(
				array('bind_param' => ':cat_id', 'value' => $cat_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			return $result;
		}

		public function getSubcategory($cat_id,$subcat_id){
			$query = '
					SELECT 		subcategory.name,
								subcategory.image,
								subcategory.description,
								category_subcategory.category_id
					FROM 		subcategory
					INNER JOIN 	category_subcategory
							ON 	category_subcategory.subcategory_id = subcategory.id
					WHERE 		subcategory.id = :subcat_id
					AND 		category_subcategory.category_id = :cat_id';
			$bindParams = array(
				array('bind_param' => ':cat_id', 'value' => $cat_id, 'type' => PDO::PARAM_INT),
				array('bind_param' => ':subcat_id', 'value' => $subcat_id, 'type' => PDO::PARAM_INT),
			);

			$result = $this->db->query($query,$bindParams);

			return $result;
		}

		public function removeCategory($cat_id){

			$data = array(
				'active' => ':status',
				'updated' => ':now',
				'updated_by' => ':user_id',
			);

			$whereClause = ' id = :cat_id';

			$bindParams = array(
				array('bind_param' => ':status', 'value' => '0', 'type' => PDO::PARAM_INT),
				array('bind_param' => ':now', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':user_id', 'value' => $_SESSION['user_id'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':cat_id', 'value' => $cat_id, 'type' => PDO::PARAM_INT),								
			);

			return $this->db->update('category',$data,$whereClause,$bindParams);
		}

		public function removeSubcategory($subcat_id){

			$data = array(
				'active' => ':status',
				'updated' => ':now',
				'updated_by' => ':user_id',
			);

			$whereClause = ' id = :subcat_id';

			$bindParams = array(
				array('bind_param' => ':status', 'value' => '0', 'type' => PDO::PARAM_INT),
				array('bind_param' => ':now', 'value' => date('Y-m-d h:i:s',time()), 'type' => PDO::PARAM_STR),
				array('bind_param' => ':user_id', 'value' => $_SESSION['user_id'], 'type' => PDO::PARAM_STR),
				array('bind_param' => ':subcat_id', 'value' => $subcat_id, 'type' => PDO::PARAM_INT),								
			);

			return $this->db->update('subcategory',$data,$whereClause,$bindParams);
		}
	}
?>