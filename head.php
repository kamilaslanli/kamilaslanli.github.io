<?php
require 'db.php';
echo '<?xml version="1.0" encoding="UTF-8" ?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">

<html lang="az-AZ" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="sohbet otagi"/>
<meta name="keywords" content="chat qonag otagi"/>

<link rel="apple-touch-icon" href="/img/moon.png" />
<link rel="shortcut icon" href="/img/favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>';
$rl = rand(100,1000);

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".intval($_GET['id'])."' and `pass`='".htmlspecialchars($_GET['ps'])."'"));


if($user['id']==0){
echo '<div class="bar ust_line rsize" style="padding:0px;margin:auto;">
<table border="0" cellpadding="0" cellspacing="0"></table>
<table class="events">
<tbody>
<tr>

<td class="main f3">'.$my_site.'</td>
<td><a href="'.$url.'/reg.php?signup='.$rl.'" title="Qeydiyyat"><img src="'.$url.'/css/bar/ic_reg.png" title="Qeydiyyat"/></a></td>
<td><a href="'.$url.'/forgot.php" title="Parol?"><img src="'.$url.'/css/bar/ic_fp.png" title="Parol?"/></a></td>

</tr>
</tbody>
</table>
</div>';
}else{
$uid = $_GET['id'];
$nkid = $_GET['nk'];

$yoxla = @mysql_query("SELECT * FROM users WHERE id='$uid'");
$msj = @mysql_fetch_array($yoxla);
$message = @mysql_result(mysql_query("SELECT COUNT(id) FROM `mail` WHERE `alan_id` = '".$msj['id']."' and `oxundu` = '0'"),0);

$yoxla_anket = @mysql_query("SELECT * FROM `users` WHERE `id`='$uid'");
$qonaq = @mysql_fetch_array($yoxla_anket);
$anket = @mysql_result(mysql_query("SELECT COUNT(id) FROM `viewanket` WHERE `uid`='".$qonaq['id']."' and `view`='0'"),0);


echo '<div class="bar ust_line rsize" style="padding:0px;margin:auto;">
<table border="0" cellpadding="0" cellspacing="0"></table>
<table class="events">
<tbody>
<tr>
<td class="main f3">'.$my_site.'</td>';
if($message > 0){
echo '<td><a href="'.$url.'/mail/index.php?id='.$uid.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;ms='.$msj['id'].'" title="Mesajlar"><img src="'.$url.'/css/bar/ic_mess.png" title="Mesajlar"/><span style="background:red;">'.$message.'</span></a>
<script type="text/javascript">
  audio = new Audio(); 
  audio.src = "mail/sms.mp3";
  audio.loop = false;
  audio.play(); 
</script></td>';
} else {
echo '<td><a href="'.$url.'/mail/index.php?id='.$uid.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;ms='.$msj['id'].'" title="Mesajlar"><img src="'.$url.'/css/bar/ic_mess.png" title="Mesajlar"/></a></td>';
}
echo '<td><a class="icon" href="'.$url.'/file/setting.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'" title="Ayarlar"><img src="'.$url.'/css/bar/ic_st.png" title="Ayarlar"/></a>
</td>';


if($anket > 0){
echo '<td><a href="'.$url.'/viewanket.php?id='.$uid.'&amp;ps='.htmlspecialchars($_GET['ps']).'" title="Qonaqlar"><img src="'.$url.'/css/bar/ic_gs.png" title="Qonaqlar"/><span style="background:red;">'.$anket.'</span></a></td>';
} else {
echo '<td><a href="'.$url.'/viewanket.php?id='.$uid.'&amp;ps='.htmlspecialchars($_GET['ps']).'" title="Qonaqlar"><img src="'.$url.'/css/bar/ic_gs.png" title="Qonaqlar"/></a></td>';
}




echo '<td>
<a class="icon" href="'.$url.'/" title="Cixis"><img src="'.$url.'/css/bar/ic_ex.png" title="Cixis"/></a>
</td>
</tr>
</tbody>
</table>
</div>';
}

echo '<div class="rsize">';
?>