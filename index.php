<?php

if( !isset($_COOKIE['PR_AUTH']) || !isset($_COOKIE['PR_MEMBER_ID'])
	|| !isset($_COOKIE['PR_LI']) || $_COOKIE['PR_LI']!=1){
	header('Refresh: 5; URL=login.php?redirect=' . $_SERVER['PHP_SELF']);
    ?>
    You're not Logged in. 'You'll  be redirected to the login page in 5 sec.<br />
    If your browser doesn't redirect you properly, <a href="login.php?redirect=<?php echo $_SERVER['PHP_SELF']; ?>">Click here</a>.
    <?php
    die();
}else{
	header('location: main.php');
}
?>
