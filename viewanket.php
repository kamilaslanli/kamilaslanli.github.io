<?php
require_once 'db.php';
require_once 'file/func.php';
require_once 'head.php';

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{


$id = $_GET['id'];
$nk = $_GET['nk'];

$k = mysql_query("SELECT * FROM users WHERE id='$id'");
$user = mysql_fetch_array($k);

$allview = @mysql_num_rows(mysql_query("SELECT * FROM `viewanket` WHERE `uid`='".$_GET['id']."' group by `kim`"));


echo '<title>Qonaqlar</title>';
echo '<div class="line-menu">Qonaqlar (<b>'.$allview.'</b>)</div><div class="menu-border"><div class="menu3">';



if($_GET['msil']!=0 and $user['id']==$_GET['id']){
	mysql_query("delete from `viewanket` where `uid`='".$_GET['id']."'");
	header('location: viewanket.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'');
}




               $all = mysql_result(mysql_query("SELECT COUNT(id) FROM `viewanket` WHERE `uid` = '".$user['id']."' AND `view`='1'"),0);
                $page=(int)$_GET['page'];
		if(empty($page)) $page=1;
		$limit=10;
		$sehife_s=ceil($all/$limit);
		if($page>$sehife_s)$page=1;
		$goster=$page*$limit-$limit;

$u=mysql_query("SELECT * FROM viewanket where `uid`='".$_GET['id']."' group by `kim` order by `id` desc limit $goster,$limit");



while($m=@mysql_fetch_assoc($u)){

$how = @mysql_num_rows(mysql_query("SELECT * FROM `viewanket` WHERE `uid`='".$m['uid']."' and `kim`='".$m['kim']."'"));
$us = $m['kimid'];
$id = $m['id'];


			
    echo '<a href="'.$url.'/info.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$us.'">'.$m['kim'].'</a> ('.$how.' defe)<hr/>';
    

if($user['id'] == $m['uid'])
{
mysql_query("UPDATE `viewanket` SET `view` = '1' WHERE `uid`='".$m['uid']."'");
}

}


if($all >=1){
echo '<a href="viewanket.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&msil='.$_GET['id'].'"><img src="'.$url.'/img/del.png"/> Temizle</a>';
}


if($allview < 1)
{
echo '<center><b>Anketinize baxan olmayib!</b></center><hr style="border-top:1px dotted #f00;"/>';
}

if($allview>$limit){
		print('<hr/><center>');
		if($page>1){
			print ('<a href="viewanket.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page-1).'">&laquo; Evvelki</a>');
                       
		}
		if($page>1){
			print(' | ');
                       
		}
		if($page!=$sehife_s){
			print ('<a href="viewanket.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page+1).'">Sonraki &raquo;</a>');
                       
		}
		 print '</center>';

	}

echo '</div><div class="menu3"><a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div></div>';
}
require_once ('foot.php');
?>