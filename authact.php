<?php
/*
 *      authact.php
 */

error_reporting(5);
include 'admin/config.php';

if(!isset($_REQUEST['do']) || !in_array(trim($_REQUEST['do']), array('login','logout'))){
	header("location: login.php");
}else{
$action = trim($_REQUEST['do']);
switch($action){
	case 'login':
		$uname = trim($_POST['user_name']);
		$upwd = trim($_POST['user_password']);
		if(is_valid($uname)){
			$login_array=login($uname,$upwd);
			if(isset($login_array['err']) && $login_array['err']==1)
				header("location: login.php?err_code=2");
			else{
				$mem_id=$login_array['id'];
				setcookie('PR_MEMBER_ID', $mem_id, 0);
				setcookie('PR_AUTH', md5($uname), 0);
				setcookie('PR_SESS_ID', $login_array['sess_id'], 0);
				setcookie('PR_FULL_NAME', $login_array['name'], 0);
				setcookie('PR_LI', 1, 0);
				header('location: main.php');
			}
		}else{
			header("location: login.php?err_code=1");
		}
	break;
	case 'logout':
		if(isset($_GET['mem_id']) && isset($_GET['sid']) && !empty($_GET['mem_id']) && !empty($_GET['sid'])){
			$logout_array=logout($_GET['mem_id'],$_GET['sid']);
			if(isset($logout_array['err']) && $logout_array['err']==0){
				setcookie('PR_MEMBER_ID', "", time()-3600);
				setcookie('PR_AUTH', "", time()-3600);
				setcookie('PR_LI', 0, time()-3600);
				header('location: login.php');
			}else{
				header('location: main.php');
			}
		}else{
			header('location: login.php');
		}
	break;
}

}

function is_valid($uname){
	$link=mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
	mysql_select_db(DB_DATABASE_NAME, $link);
	$uname=clean($uname);
	$query="SELECT id FROM pt_users WHERE uname='{$uname}'";
	$temp=mysql_query($query);
	$row=mysql_fetch_row($temp);
	$item=mysql_num_rows($temp);
	mysql_close($link);
	if(mysql_num_rows($temp) > 0)
		return true;
	else if(mysql_num_rows($temp) == 0)
		return false;
}

function clean($str){
    $str = mysql_real_escape_string($str);
    return $str;
}

function login($uname,$upwd){
	$login_array = array();
	$link=mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
	mysql_select_db(DB_DATABASE_NAME, $link);
	$uname=clean($uname);
	$upwd=md5($upwd);
	$query="SELECT id, full_name FROM pt_users WHERE uname='{$uname}' AND upwd='{$upwd}'";
	$temp=mysql_query($query);

	if(mysql_num_rows($temp) > 0){
		$uniq_id=uniqid();
		$ts=time();
		$login_array['err']=0;
		$res=mysql_fetch_assoc($temp);
		$login_array['id']=$res['id'];
		$login_array['name']= (empty($res['full_name'])) ? "User" : $res['full_name'];
		$login_array['sess_id']=$uniq_id;
		$ins_query="INSERT INTO pt_session_log(`member_id`, `session_id`, `timestamp`) VALUES({$res['id']}, '{$uniq_id}', {$ts})";
		mysql_query($ins_query);
	}
	else if(mysql_num_rows($temp) == 0){
		$login_array['err']=1;
	}
	mysql_close($link);
	return $login_array;
}


function logout($memid,$sid){
	$logout_array = array();
	$link=mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
	mysql_select_db(DB_DATABASE_NAME, $link);
	$memid=clean($memid);
	$query="SELECT *
					FROM  `pt_session_log`
					WHERE member_id ={$memid}
					AND id = (
					SELECT MAX( id )
					FROM `pt_session_log`
					WHERE member_id ={$memid} )";

	$temp=mysql_query($query);
	if(mysql_num_rows($temp) > 0){
		$res=mysql_fetch_assoc($temp);
		if($sid==$res['session_id']){
			$logout_array['err']=0;
		}else{
			$logout_array['err']=1; //session id doesnt match. Possible hack attempt
		}
	}
	else if(mysql_num_rows($temp) == 0){ //No login record found
		$logout_array['err']=1;
	}
	mysql_close($link);
	return $logout_array;
}
?>
