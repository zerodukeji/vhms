<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
header("Cache-Control: no-cache, must-revalidate");
define('TPL_ROOT','/user');
define('APPLICATON_ROOT', dirname(__FILE__));
define('SYS_ROOT', dirname(dirname(__FILE__)).'/framework');
define('DEFAULT_CONTROL', 'public');
include(SYS_ROOT . '/runtime.php');
$c=$_REQUEST['c'];
$a=$_REQUEST['a'];
$e=$_REQUEST['e'];
if($c==""){
	$_REQUEST['c']=$c='frame';
	$_REQUEST['a']=$a='index';
}
$tpl = TPL::singleton();
$tpl->assign('frame',1);
$GLOBALS['frame'] = 1;
if($c=='frame' && $a=='index'){
	$fc = $_REQUEST['fc'];
	$fa = $_REQUEST['fa'];
	if($fc==""){
		$fc = 'user';
	}
	if($fa==""){
		$fa = 'index';
	}
	$tpl->assign("fc",$fc);
	$tpl->assign("fa",$fa);
}
@load_conf('pub:setting');
$tpl->assign('setting',$GLOBALS['setting_cfg']);
$main = dispatch($c,$a);
//startFramework();
$tpl->assign("title",getTitle());
$tpl->assign('main',$main);
$tpl->display('frame.html');
?>