<?php
require_once '../db.php';
require_once 'func.php';
require_once '../head.php';

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{


$id = $_GET['id'];
$nk = $_GET['nk'];

$k = mysql_query("SELECT * FROM users WHERE id='$id'");
$user = mysql_fetch_array($k);

$alluser = @mysql_result(@mysql_query("select count(*) from `users`"),0);


echo '<title>İstifadəçi Siyahısı</title>';
echo '<div class="line-menu">İstifadəçi Siyahısı (<b>'.$alluser.'</b>)</div><div class="menu-border">';


if($_GET['ndel']!=0 and $user['id']==1){
if($_GET['ok']==1){
	mysql_query("delete from `users` where `id`='".$_GET['ndel']."'");
	mysql_query("delete from `mesaj` where `uid`='".$_GET['ndel']."'");
	header("location: alluser.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
	}
	print('<div class="menu3">&raquo; <u><b>'.$_GET['nick'].'</b></u> -  nikini silmek istediyinize eminsiniz ?<br/>
	[<a href="alluser.php?id='.$_GET['id'].'&ps='.$_GET['ps'].'&ndel='.$_GET['ndel'].'&ok=1&ref='.$ref.'">Beli</a>] | [<a href="alluser.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Xeyr</a>]
	</div>');
}



               $all=@mysql_result(@mysql_query("select count(*) from `users`"),0);
                $page=(int)$_GET['page'];
		if(empty($page)) $page=1;
		$limit=10;
		$sehife_s=ceil($all/$limit);
		if($page>$sehife_s)$page=1;
		$goster=$page*$limit-$limit;
	

$u=mysql_query("SELECT * FROM users order by `id` desc limit $goster,$limit");

$i = $goster+1;

while($m=@mysql_fetch_array($u)){

    
    $us = $m['user'];
    $id = $m['id'];

$userinf=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$m['id']."'"));
			
    echo '<div class="menu3">'.$i++.') <img src="'.$url.'/img/'.($userinf['sex']==1 ? 'men' : 'girl').'.png" alt="icon"/><a href="'.$url.'/info.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$id.'">'.$us.'</a> '.($user['id']==1 ? ' - <a href="alluser.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nick='.$userinf['user'].'&ndel='.$m['id'].'"><img src="../img/del.png" alt="sil"/></a>' : '').'</div>';
    
}


if($alluser>$limit){
		print('<div class="menu3"><center>');
		if($page>1){
			print ('<a href="alluser.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page-1).'">&laquo; Evvelki</a>');
                       
		}
		if($page>1){
			print(' | ');
                       
		}
		if($page!=$sehife_s){
			print ('<a href="alluser.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page+1).'">Sonraki &raquo;</a>');
                       
		}
		 print '</center></div>';

	}

echo '<div class="menu3"><a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div></div>';
}
require_once ('../foot.php');
?>