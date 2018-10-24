<!-- Template Header of the page -->
<?php require_once APP_ROOT . '/view/includes/header.php'; ?>

<!-- Main content of the site goes here -->
<div id="inputContainer">
	<p><?php flash('register_success'); ?></p>
	<form id="loginForm" action="login" method="POST">

		<h1>Log in to your account</h1>

		<label for="logEmail">Username</label>
		<input type="email" name="logEmail" id="logEmail" placeholder="Enter your email" required value="<?php echo $data['email']; ?>">
		<p><?php echo $data['emailErr']; ?></p>

		<label for="logPassword">Password</label>
		<input type="password" name="logPassword" id="logPassword" placeholder="Enter your password" required>

		<button>Login</button>
		
	</form>
</div>

<!-- Templte Footer of the page -->
<?php require_once APP_ROOT.'/view/includes/footer.php'; ?>