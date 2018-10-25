<?php  
class Users extends Controller {
	public function __construct() {
		$this->userModel = $this->model('user');
	}

	public function index() {
		$this->view('home/index');
	}

	public function login() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Sanitize POST data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				// Placeholder for POST data
				'email' => trim($_POST['logEmail']),
				'password' => trim($_POST['logPassword']),

				// Placeholder for errors
				'emailErr' => '',
				'passwordErr' => ''
			];

			// Validate email
			if ( empty($data['email']) ) {
				$data['emailErr'] = 'Please enter your e-mail address';
			}

			// Validate password 
			if ( empty($data['password']) ) {
				$data['passwordErr'] = 'Please enter your password';
			}

			// Check if user exist using email
			if ( !$this->userModel->findUserByEmail($data['email']) ) {
				$data['emailErr'] = 'No user found';
			}

			if ( empty($data['emailErr']) && empty($data['passwordErr']) ) {
				$loggedInUser = $this->userModel->login($data['email'], $data['password']);

				if ($loggedInUser) {
					// Create user session
					$this->userModel->createUserSession($loggedInUser);
				}
				else {
					// display this message and don't give hackers a hint what is wrong
					$data['passwordErr'] = 'Incorrect username or password';
					$this->view('users/login', $data);
				}
			}
			else {
				// Load login form with errors
				$this->view('users/login', $data);
			}
		}
		else {
			// initialize placeholders
			$data = [
				'email' => '',
				'password' => '',
				'emailErr' => '',
				'passwordErr' => ''
			];

			$this->view('users/login', $data);
		}
	}

	public function register() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Sanitize POST data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				// Placeholder from fetched POST data
				'fname' => trim($_POST['regFname']),
				'lname' => trim($_POST['regLname']),
				'email' => trim($_POST['regEmail']),
				'password' => trim($_POST['regPass']),
				'confirmPassword' => trim($_POST['regConfirmPass']),

				// Placeholder for errors
				'fnameErr' => '',
				'lnameErr' => '',
				'emailErr' => '',
				'passwordErr' => '',
				'confirmPassErr' => ''
			];

			// Validate first name
			if ( empty($data['fname']) ) {
				$data['fnameErr'] = 'You must enter your first name';
			}
	
			// Validate last name
			if ( empty($data['lname']) ) {
				$data['lnameErr'] = 'You must enter your last name';
			}		

			// Validate email
			if ( empty($data['email']) ) {
				$data['emailErr'] = 'Please enter your e-mail address';
			}
			else {
				// Check if email was taken or not
				if ( $this->userModel->findUserByEmail($data['email']) ) {
					$data['emailErr'] = 'Email already taken';
				}
			}

			// Validate password
			if ( empty($data['password']) ) {
				$data['passwordErr'] = 'You must enter your first name';
			}		
			elseif ( strlen($data['password']) < 6 ) {
				$data['passwordErr'] = 'Password must have a least 6 characters';
			}	

			// Validate password confirmation
			if ( empty($data['confirmPassword']) ) {
				$data['confirmPassErr'] = 'Please confirm your password';
			}
			else {
				if ($data['password'] !== $data['confirmPassword']) {
					$data['confirmPassErr'] = 'Passwords did not match';
				}
			}

			// Make sure errors are empty, then go ahead and register or add a new user
			if ( empty($data['fnameErr']) && empty($data['lnameErr']) && empty($data['emailErr']) && empty($data['passwordErr']) && empty($data['confirmPassErr']) ) {
				// Hash password 
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				// Add user to database
				if ( $this->userModel->register($data) ) {
					flash('register_success', 'You are now registered');
					redirect('users/login');
				} 
				else {
					die('Cannot add user');
				}
			}
			else {
				// Load register page with errors
				$this->view('users/register', $data);
			}
		}
		else {
			// initialize placeholders
			$data = [
				'fname' => '',
				'lname' => '',
				'email' => '',
				'password' => '',
				'confirmPassword' => '',
				'fnameErr' => '',
				'lnameErr' => '',
				'emailErr' => '',
				'passwordErr' => '',
				'confirmPassErr' => ''
			];

			$this->view('users/register', $data);
		}
	}
}
?>