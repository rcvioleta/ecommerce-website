<?php  
class User {
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function findUserByEmail($email) {
		$this->db->query('SELECT * FROM users WHERE email = :email');
		// Bind values
		$this->db->bind(':email', $email);

		$row = $this->db->singleResult();

		if ($this->db->rowCount() > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function login($email, $password) {
		$this->db->query('SELECT * FROM users WHERE email = :email');
		// Bind values
		$this->db->bind(':email', $email);

		$row = $this->db->singleResult();
		$hashedPassword = $row->password;

		if ( password_verify($password, $hashedPassword) ) {
			return $row;
		}
		else {
			return false;
		}
	}

	public function register($data) {
		$this->db->query('INSERT INTO users (firstname, lastname, email, password) 
			                VALUES(:firstname, :lastname, :email, :password)');

		// Bind values
		$this->db->bind(':firstname', $data['fname']);
		$this->db->bind(':lastname', $data['lname']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		if ($this->db->execute()) {
			return true;
		}
		else {
			return false;
		}
	}

	public function createUserSession($user) {
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name'] = $user->firstname; 
		redirect('users/index');
	}

	public function logout() {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		session_destroy();
		redirect('users/login');
	}
}
?>