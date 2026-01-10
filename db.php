<?php
require_once __DIR__ . '/compat_mysql.php';
session_start();
ob_start();
$my_site='ROMAZ.TK';
$url = 'http://'.$_SERVER['SERVER_NAME'].'/chat';   // gb yerine hansi papqada qurulubsa onu yazin eyer papqa yoxdursa gb silin $_SERVER['SERVER_NAME'];
define('db_host','fdb33.awardspace.net');
define('db_name','4724875_base');
define('db_user','4724875_base');
define('db_pass','Kod777000');
@mysql_connect(db_host,db_user,db_pass);
@mysql_select_db(db_name) or die('Baza ile elaqe kesilib!');



//mysql_query("SET NAMES UTF8");

?>