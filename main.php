<?php
/*
 *      main.php
 *
 */
require_once 'auth.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Priktr</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.20" />
	<link rel="stylesheet" href="main_style.css" />
	<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="header">
	<div id="header-menu">Hi <?php echo $_COOKIE['PR_FULL_NAME']; ?>.
		<span><a href="authact.php?do=logout&mem_id=<?php echo $_COOKIE['PR_MEMBER_ID']; ?>&sid=<?php echo $_COOKIE['PR_SESS_ID']; ?>" >Logout</a></span>
	</div>
	<div id="header-logo">Prik<span>tr</span></div>
	<div class="clear"></div>
	<div id="header-second-menu">Navigation stuff here</div>
</div>

<div id="content">
	<p>
		<pre>
			<?php
			print_r($_COOKIE);
			?>
		</pre>
	</p>
</div>
</body>

</html>
