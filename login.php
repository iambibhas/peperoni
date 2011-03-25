<?php
/*
 *      login.php
 *
 */

if( isset($_COOKIE['PR_AUTH']) && isset($_COOKIE['PR_MEMBER_ID'])
	&& isset($_COOKIE['PR_LI']) &&	$_COOKIE['PR_LI']==1){
	header("location: main.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Log In | Priktr</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="style.css" />
	<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
</head>

<body onload="document.all.user_name.focus()">
<div id="login-box">
	<div id="login-logo">Prik<span>tr</span></div>
	<form action="authact.php" method="post" name="login_form">
		<input type="hidden" name="do" value="login" />
		<p><input type="text" name="user_name" /></p>
		<p><input type="password" name="user_password" onkeydown="if (event.keyCode == 13) document.login_form.submit()" /></p>
		<p><a id="login-button" href="#" onclick="document.login_form.submit()">Login</a></p>
		<?php
		if(isset($_GET['err_code']) && trim($_GET['err_code'])==1):
			?>
			<p class="error">Wrong username.</p>
			<?php
		elseif(isset($_GET['err_code']) && trim($_GET['err_code'])==2):
			?>
			<p class="error">Wrong password.</p>
			<?php
		endif;
		?>
	</form>
</div>
</body>

</html>
