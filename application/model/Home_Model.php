<?php
	class Home_Model extends Model{

		function display(){
			//print_r($this->db_config);
			$this->db->sampleQuery();
		}


	}
?>