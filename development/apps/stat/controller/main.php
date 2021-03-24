<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE
 * @package Controller\Main
 */
namespace Controller;
class Main
{
	use \Library\Shared;

	private $model;

	public function exec():?array {
		$result = null;
		$url = $this->getVar('REQUEST_URI', 'e');
		$path = explode('/', $url);

		if (isset($path[2]) && !strpos($path[1], '.')) { // Disallow directory changing
			$file = ROOT . 'model/config/methods/' . $path[1] . '.php';
			if (file_exists($file)) {
				include $file;
				if (isset($methods[$path[2]])) {
					$details = $methods[$path[2]];
					$request = [];
					$success = true;
					include ROOT . 'model/config/patterns.php';
					foreach ($details['params'] as $param) {
						$var = $this->getVar($param['name'], $param['source']);
						if ($var){
							if(isset($patterns[$param['pattern']]  )){
								if(isset($patterns[$param['pattern']]['callback'])){
									$truestring = 0;
									$truestring = preg_match($patterns[$param['pattern']]['regex'], $var);
									if($truestring != 0) 
										$var = preg_replace_callback($patterns[$param['pattern']]['regex'], $patterns[$param['pattern']]['callback'], $var);
									else
										throw new \Exception('REQUEST_INCORRECT', 2);
									
								}
								$request[$param['name']] = $var;
							}
							else
								throw new \Exception('REQUEST_INCORRECT', 2);
					
						}
						else if($param['required'] == 'true'){
							$success = false;
							throw new \Exception('REQUEST_INCOMPLETE', 1);
							break;
						}
					}
					if ($success && method_exists($this->model, $path[1] . $path[2])) {
						$method = [$this->model, $path[1] . $path[2]];
						$result = $method($request);
					}

				}

			}
		}

		return $result;
	}

	public function __construct() {
		// CORS configuration
		$origin = $this -> getVar('HTTP_ORIGIN', 'e');
		$domain = $this -> getVar('FRONT','e');
		foreach ( [$domain] as $allowed )
			if ( $origin == "https://$allowed") {
				header( "Access-Control-Allow-Origin: $origin" );
				header( 'Access-Control-Allow-Credentials: true' );
			}
		$this->model = new \Model\Main;
	}
}