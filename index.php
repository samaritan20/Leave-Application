<?php
	session_start();
	if(isset($_SESSION['sub']))
		header('Location: ./php/form.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>VESIT Leave Application!</title>
	
	<!-- Google MDL -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

	<!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<!-- Google OAuth -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="966732769863-vbk66rqc2gaekf6ad7sf0uk64cei4gee.apps.googleusercontent.com">
	<script>
		function onSignIn(googleUser) {
			var xhr = new XMLHttpRequest();
			xhr.responseType = 'text';
			xhr.open('POST', './token.php');
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onload = function() {
				if (xhr.response == 'login')
					window.location='./php/form.php';
				else {
					document.getElementById('error').innerHTML = xhr.response;
					console.log(xhr.response);
					$(".mdl-spinner").hide();
					signOut();
					$(".g-signin2").show();
				}
			};
			xhr.send('idtoken=' + googleUser.getAuthResponse().id_token);
		}

		function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            });
        }

		$(document).ready(function(){
			$(".mdl-spinner").hide();
			$('.g-signin2').on('click',function(){
				$(".g-signin2").hide();
				$(".mdl-spinner").show();
				$(".mdl-spinner").addClass("is-active");
			});
		});
	</script>
</head>
<body>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
		<header class="mdl-layout__header mdl-layout__header--scroll">
			<div class="mdl-layout__header-row">
				<span class="mdl-layout-title">Welcome!</span>
				<div class="mdl-layout-spacer"></div>
				<nav class="mdl-navigation">
				</nav>
			</div>
		</header>
		<?php include_once './drawer.php'; ?>
		<main class="mdl-layout__content">
			<div class="mdl-grid">
				<div class="mdl-layout-spacer"></div>
				<div class="mdl-cell--4-col-phone mdl-cell--6-col-tablet mdl-cell--11-col-desktop">
					<div class="mdl-card mdl-shadow--8dp" style="width: 100%;">
						<div class="mdl-card__title">
							<h1 class="mdl-card__title-text" id="title">VESIT leave application!</h1>
						</div>
						<div class="mdl-card__supporting-text">
							<ul class="mdl-list">
								<li class="mdl-list__item mdl-list__item--three-line">
									<span class="mdl-list__item-primary-content">
										<i class="material-icons mdl-list__item-avatar">&#xE86C;</i>
										<span>No sign-up required!</span>
										<span class="mdl-list__item-text-body">Login with your existing Google account! No hassle of sign-up.</span>
									</span>
								</li>
								<li class="mdl-list__item mdl-list__item--three-line">
									<span class="mdl-list__item-primary-content">
										<i class="material-icons mdl-list__item-avatar">&#xE86C;</i>
										<span>Easy to apply!</span>
										<span class="mdl-list__item-text-body">Just fill out a quick form and click apply! Pretty simple.</span>
									</span>
								</li>
								<li class="mdl-list__item mdl-list__item--three-line">
									<span class="mdl-list__item-primary-content">
										<i class="material-icons mdl-list__item-avatar">&#xE86C;</i>
										<span>Get notified immediately!</span>
										<span class="mdl-list__item-text-body">Receive an email as soon as your leave is approved!</span>
									</span>
								</li>
							</ul>
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<div class="g-signin2" data-onsuccess="onSignIn" data-prompt='select_account'></div>
							<div class="mdl-spinner mdl-js-spinner"></div>
							<span id='error' style='color: red;'></span>
			            </div>
					</div>
				</div>
				<div class="mdl-layout-spacer"></div>
			</div>
		</main>
	</div>
</body>
</html>