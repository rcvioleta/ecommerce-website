<!-- Template Header of the page -->
<?php require_once APP_ROOT.'/view/includes/header.php'; ?>

<!-- Main content of the site goes here -->
<div id="inputContainer">
	<form id="loginForm" action="<?php echo URL_ROOT; ?>/users/register" method="POST">

		<h1>Register an account</h1>
		<?php echo $data['emailErr']; ?>

		<label for="regFname">First name</label>
		<input type="text" name="regFname" id="regFname" placeholder="First name" required value="<?php echo $data['fname'] ?>">

		<label for="regLname">Last name</label>
		<input type="text" name="regLname" id="regLname" placeholder="Last name" required value="<?php echo $data['lname'] ?>">

		<label for="regEmail">E-mail</label>
		<input type="email" name="regEmail" id="regEmail" placeholder="E-mail address" required value="<?php echo $data['email'] ?>">		

		<label for="regPass">Password</label>
		<input type="password" name="regPass" id="regPass" placeholder="Enter your password" required>

		<label for="regConfirmPass">Confirm password</label>
		<input type="password" name="regConfirmPass" id="regConfirmPass" placeholder="Confirm password" required>	

		<button>Register</button>

	</form>
</div>

<!-- Templte Footer of the page -->
<?php require_once APP_ROOT.'/view/includes/footer.php'; ?>