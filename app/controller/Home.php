<?php  
class Home extends Controller {
	public function index() {
		$data = [
			'login' => 'Click here to <a href="users/index">login</a>.',
			'register' => 'Or, <a href="users/register">register</a> if you don\'t have an account.'
		];

		$this->view('home/index', $data);
	}
}
?>