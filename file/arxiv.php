<?php
require_once ('../db.php');
require_once ('../file/func.php');
require_once ('../head.php');


if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{

$id = $_GET['id'];
$nk = $_GET['nk'];
$mesaj = htmlspecialchars($_POST['text']);

$k = mysql_query("SELECT * FROM users WHERE id='$id'");
$user = @mysql_fetch_array($k);


if($user['id']==0){
print('<div class="menu3"><div class="menu-border">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="/">Geri</a></div>');
} else {

echo '<title>Arxiv Mesajlar</title>';
echo '<div class="line-menu">Arxiv Mesajlar</div><div class="menu-border"><div class="menu3">';

$all=@mysql_num_rows(mysql_query("SELECT * FROM `mail` WHERE `alan_id`='".$user['id']."' GROUP BY `gonderen_id`"));


 $page=(int)$_GET['page'];
		if(empty($page)) $page=1;
		$limit=10;
		$sehife_s=ceil($all/$limit);
		if($page>$sehife_s)$page=1;
		$goster=$page*$limit-$limit;


function nick($nk){
    $users = @mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$nk."' ORDER BY `id` DESC LIMIT 1"));
    return (empty($users)?'[Nick Silinib]':'<b>'.$users['user'].'</b>');
}


$listx = @mysql_fetch_assoc(mysql_query("SELECT * FROM `mail` WHERE `alan_id` = '".$user['id']."' and `gonderen_id` = '".$d['gonderen_id']."' or `alan_id` = '".$d['gonderen_id']."' and `gonderen_id` = '".$user['id']."' ORDER BY `vaxt` DESC LIMIT 1"));
 
$dialog = mysql_query("SELECT * FROM `mail` WHERE `alan_id`= '".$user['id']."' GROUP BY `gonderen_id` ORDER BY `id` DESC LIMIT $goster,$limit");


while($d = @mysql_fetch_assoc($dialog)){
$kim = @mysql_num_rows(mysql_query("SELECT * FROM `mail` WHERE `alan_id`='".$d['alan_id']."' and `gonderen_id`='".$d['gonderen_id']."'"));
$kime = @mysql_num_rows(mysql_query("SELECT * FROM `mail` WHERE `gonderen_id`='".$d['alan_id']."' and `alan_id`='".$d['gonderen_id']."'"));
$cem = $kim+$kime;

echo '&raquo; '.nick($d['gonderen_id']).'<br/>';

$list = @mysql_fetch_assoc(mysql_query("SELECT * FROM `mail` WHERE `alan_id` = '".$user['id']."' and `gonderen_id` = '".$d['gonderen_id']."' or `alan_id` = '".$d['gonderen_id']."' and `gonderen_id` = '".$user['id']."' ORDER BY `id` DESC LIMIT 1"));

if(nick($d['gonderen_id']) !== nick($list['gonderen_id'])){
echo 'Mən: ';
}

echo ''.substr($list['mesaj'],0,30).'';
if(!empty($d['oxundu']) == 0){
echo '<b> <font color="red">Yeni</font></b>';
}
echo '<a href="'.$url.'/mail/mail.php?id='.$id.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$d['gonderen_id'].'">... '.$cem.'</a><hr/>';

}

if($all < 1)
{
echo '<center><b>Mesaj qutusu boşdur!</b></center><hr style="border-top:1px dotted #f00;"/>';
}


if($all>$limit){
		print('<center>');

if($page>1){
			print ('<a href="arxiv.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page-1).'">&laquo; Evvelki</a>');
                       
		}
		if($page>1){
			print(' | ');
                       
		}
		if($page!=$sehife_s){
			print ('<a href="arxiv.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page+1).'">Sonraki &raquo;</a>');
                       
		}
 print '</center><hr/>';

}



/*
if ($k_page > 1) {
echo str(''.$url.'/file/arxiv.php?id='.$id.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;',$k_page,$page); 
echo '<hr/>';
}
*/
echo '<a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div></div>';
}

}
require_once ('../foot.php');
?>