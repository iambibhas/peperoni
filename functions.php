<?php
/*
 *      functions.php
 *
 */
include 'config.php'
function get_path_from_slug($slug){
	$link=mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
	mysql_select_db(DB_DATABASE_NAME, $link);
}
?>
