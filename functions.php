<?php
/*
 *      functions.php
 *
 */
include 'admin/config.php';
function get_details_from_slug($slug, $action){
	$link=mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
	mysql_select_db(DB_DATABASE_NAME, $link);
	$slug=clean($slug);
	if($action=="path")
		$query="SELECT location FROM pt_images WHERE slug='{$slug}'";
	elseif($action=="all")
		$query="SELECT * FROM pt_images WHERE slug='{$slug}'";

	$raw_result=mysql_query($query);
	if(mysql_num_rows($raw_result)>0){
		$result = mysql_fetch_assoc($raw_result);
	}else{
		$result=array("err"=>1);
	}
	return $result;
}
function clean($str){
    $str = mysql_real_escape_string($str);
    return $str;
}
?>
