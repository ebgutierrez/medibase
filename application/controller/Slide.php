<?php
	
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	class Slide extends Controller {
		public function main(){
			if ($handle = opendir($this->image_resource . '/slide')) {

				$images = array();
			    /* This is the correct way to loop over the directory. */
			    while (false !== ($entry = readdir($handle))) {
			        if($entry != '.' && $entry != '..' && $entry != '...') 
			        	$images[] = $entry;
			    }

			    /* This is the WRONG way to loop over the directory. */
			    while ($entry = readdir($handle)) {
			    }

			    echo json_encode($images);

			    closedir($handle);
			}
		}
	}
?>