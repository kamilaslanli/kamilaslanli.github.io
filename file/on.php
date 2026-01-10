<?php
require_once '../db.php';
require_once 'func.php';
require_once '../head.php';

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{


$id = $_GET['id'];
$nk = $_GET['nk'];

$k = mysql_query("SELECT * FROM users WHERE id='$nk'");
$user = mysql_fetch_array($k);

$alluser = @mysql_result(@mysql_query("select count(*) from `users`"),0);

$all_on = @mysql_result(@mysql_query("select count(*) from `users` where `on`>".time().""),0);


echo '<title>Online İstifadəçilər</title>';


echo '<div class="line-menu">Online İstifadəçilər (<b>'.$all_on.'</b>)</div>
<div class="menu-border">';

//echo '<div class="menu3"><center>Bütün İstifadəçilər (<a href="'.$url.'/file/alluser.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">'.$alluser.'</a>)</center></div>';


               $all=@mysql_result(@mysql_query("select count(*) from `users`"),0);
                $page=(int)$_GET['page'];
		if(empty($page)) $page=1;
		$limit=10;
		$sehife_s=ceil($all/$limit);
		if($page>$sehife_s)$page=1;
		$goster=$page*$limit-$limit;


function nick($nk){
    $users = @mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$nk."' LIMIT 1"));
    return (empty($users)?'[Nick Silinib]':'<b>'.$users['user'].'</b>');
}
        mysql_query("update `users` set `on`='".(time()+300)."' where `id`='".intval($_GET['id'])."'");
	$u = mysql_query("SELECT * FROM `users` where `on` > '".(time()-200)."' ORDER BY `on` DESC LIMIT $goster, $limit");

$i = $goster+1;

while($m=@mysql_fetch_assoc($u)){

    $us = $m['user'];
    $id = $m['id'];
    
    
    
    echo '<div class="menu3">'.$i++.') <a href="'.$url.'/info.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$id.'">'.nick($m['id']).'</a> <div style="float:right;"><a href="'.$url.'/mail/mail.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$id.'"><img src="'.$url.'/img/mesaj.png" alt="mesaj"/></a></div></div>';
    
}

echo '<div class="menu3"><a href="'.$url.'/file/alluser.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'"><img src="../img/users.png" title="Istifadeciler" alt="users"/> İstifadəçilər</a> ('.$alluser.'</a>)</div>';


if($all_on>$limit){
		print('<div class="menu3"><center>');
		if($page>1){
			print ('<a href="on.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page-1).'">&laquo; Evvelki</a>');
                       
		}
		if($page>1){
			print(' | ');
                       
		}
		if($page!=$sehife_s){
			print ('<a href="on.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page+1).'">Sonraki &raquo;</a>');
                       
		}
		 print '</center></div>';

	}


echo '<div class="menu3"><a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div></div>';
}
require_once ('../foot.php');
?>