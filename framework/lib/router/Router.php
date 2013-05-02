<?php
	if(!defined('SERVER_ROOT'))
		die ('Unauthorized access. File forbidden.');

	include 'RouterAccessors.php';

	class Router extends RouterAccessors{

		public function __construct(){
			$this->_segments = array();
		}

		public function mapController(){

			include $_SERVER['lib'] . '/controller/Controller.php';
			include $_SERVER['lib'] . '/session/Session.php';
			include $_SERVER['helper'] . '/Form.php';
			include $_SERVER['tools'] . '/Tools.php';


			$controllerClass = null;
			$folderPath = '';
			$function = '';
			$found = false;
			$lastSegment = '';


			if(empty($this->_segments[0])){
				include $_SERVER['application'] . '/config/Router.php';



				if(empty($rtr_config))
					throw new Exception('No default page specified');
				else{					


					$className = ucfirst(strtolower($rtr_config['default']));


					include $_SERVER['application'] . '/controller/' . $className . '.php';



					$controllerClass = $className::getInstance($className);

					$found = true;
				}
			} else {


				foreach ($this->_segments as $segment) {

					//check if first segment in the root
					if(file_exists($_SERVER['application'] . '/controller' . $folderPath . '/' . ucfirst(strtolower($segment)) . '.php')) {
						include $_SERVER['application'] . '/controller' . $folderPath . '/' .ucfirst(strtolower($segment)) . '.php';

						
						$className =  ucfirst(strtolower($segment));
						$controllerClass = $className::getInstance($className);

						$found = true;
						$lastSegment = $className;

						continue;
					} else if(is_dir($_SERVER['application'] . '/controller/' . ucfirst(strtolower($segment)))) {

						
						$folderPath .= '/' . ucfirst(strtolower($segment));
					}


					//check for function calls
					if($controllerClass != null && empty($function)) {
						$function = $segment;
					}
				}
			}
			
			if(empty($function))
				$function = 'main';

			if(!$found) {
				include $_SERVER['application'] . '/config/Router.php';
			
				$path = $rtr_config['base_url'];
				
				header('Location: ' . $path);
			}
				
			
			$controllerClass->{$function}();
		}

		public function mapView(){

			$folderPath = '';
			$found = false;
			$lastSegment = '';


			foreach ($this->_segments as $segment) {

				//check if first segment in the root
				if(file_exists($_SERVER['application'] . '/view' . $folderPath .'/'. ucfirst($segment) . '.php')) {

					return $_SERVER['application'] . '/view' . $folderPath;

				} else if(is_dir($_SERVER['application'] . '/view/' . $segment)) {
					$folderPath .= '/' . $segment;
				}

			}
			

			if(!$found)
				throw new Exception('View '. $segment . ' not found');
		}

		public function mapModel(){

			
			require_once $_SERVER['lib'] . '/model/Model.php';

			$modelClass = null;
			$folderPath = '';
			$found = false;
			$lastSegment = '';

			foreach ($this->_segments as $segment) {

				//check if first segment in the root
				if(file_exists($_SERVER['application'] . '/model' . $folderPath . '/' . ucfirst($segment) . '.php')) {
					
					include $_SERVER['application'] . '/model' . $folderPath . '/' .ucfirst($segment) . '.php';

					$className =  ucfirst($segment);
					$modelClass = new $className;
					
					return $modelClass;
				} else if(is_dir($_SERVER['application'] . '/model/' . $segment)) {
					$folderPath .= '/' . $segment;
				}
			}
			

			if(!$found)
				throw new Exception('Model '. $segment . ' not found');
		}
	}
?>