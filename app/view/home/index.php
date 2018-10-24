<?php require_once APP_ROOT . '/view/includes/header.php';	?>
	
	<header class="header">
		<div class="logo-box">
			<img class="logo" src="<?php echo URL_ROOT . '/images/logo.png'; ?>" alt="website-logo">
		</div>

		<div class="text-box">
			<h1 class="heading-primary">
				<span class="heading-primary-main">Myspotify</span>
				<span class="heading-primary-sub">Listen to music anywhere</span>
				<div class="u-center-text">
					<a href="#get-started">Get Started</a>
				</div>
			</h1>
	</div>	
	</header>

	<main id="get-started">
		<section class="section-login">
			<div class="row">
				<div class="login-form">
					<div class="u-margin-bottom-2">
						<h2 class="heading-secondary">
							Login or Sign up
						</h2>
					</div>		


					<form action="#" class="form">
						<div class="form_group">
							<input type="email" class="form_input" id="email" name="email" placeholder="Email address" required>
							<label for="email" class="form_label">Email Address</label>
						</div>

						<div class="form_group">
							<input type="password" class="form_input" id="password" name="password" placeholder="Password" required>
							<label for="password" class="form_label">Password</label>
						</div>

						<div class="form_group">
							<button class="btn btn_green">Login</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>