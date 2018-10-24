<?php
/**
 * Core of the framework that manages controller and model
 */  
class Core {
	private $controller = 'Home';
	private $method = 'index';
	private $param = [];

	public function __construct() {
		$url = $this->getUrl();
		$currentController = ucfirst($url[0]);

		if (file_exists('../app/controller/'.$currentController.'.php')) {
			$this->controller = $currentController;
			unset($url[0]);
		}

		require_once '../app/controller/'.$this->controller.'.php';
		$this->controller = new $this->controller;

		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->param = $url ? array_values($url) : [];
		call_user_func_array([$this->controller, $this->method], $this->param);
	}

	public function getUrl() {
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		} 
	}
}
?>