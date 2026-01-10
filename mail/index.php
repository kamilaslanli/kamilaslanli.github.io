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
print('<div class="menu3">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="/">Geri</a></div>');
} else {

echo '<title>Mesajlar</title>';
echo '<div class="line-menu">Mesajlar</div>';
if (empty($user['max'])) $user['max']=10;
$max = $user['max'];
$k_post = mysql_result(mysql_query("SELECT COUNT(id) FROM `mail` WHERE `alan_id` = '".$user['id']."' AND `oxundu`='0'"),0);
$k_page = k_page($k_post,$max);
$page = page($k_page);
$start = $max*$page-$max;

function nick($nk){
    $users = @mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$nk."' LIMIT 1"));
    return (empty($users)?'[Nick Silinib]':'<b>'.$users['user'].'</b>');
}



$list = @mysql_fetch_assoc(mysql_query("SELECT * FROM `mail` WHERE `alan_id` = '".$user['id']."' and `gonderen_id` = '".$d['gonderen_id']."' or `alan_id` = '".$d['gonderen_id']."' and `gonderen_id` = '".$user['id']."' ORDER BY `vaxt` DESC LIMIT 1"));

$dialog = mysql_query("SELECT * FROM `mail` WHERE `alan_id`= '".$user['id']."' AND `oxundu`='0' ORDER BY `id` DESC LIMIT $start,$max"); 

while($d = @mysql_fetch_array($dialog))
{
echo '<div class="menu3">&raquo; '.nick($d['gonderen_id']).' ['.$d['vaxt'].']';

/*
if(!empty($d['oxundu']) == 0)
{
echo '<b> <font color="red">Yeni</font></b>';
}
*/
echo ' - <a href="'.$url.'/mail/mail.php?id='.$id.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$d['gonderen_id'].'"> Arxiv</a></div>';


}


$list = @mysql_fetch_assoc(mysql_query("SELECT * FROM `mail` WHERE `gonderen_id` = '".$d['gonderen_id']."' ORDER BY `id` DESC LIMIT 1"));

//echo 'Mesaj: '.substr(bb_code($d['mesaj']),0,50).'';

echo '<div class="menu3">';


if($k_post < 1)
{
echo '<center><b>Mesaj qutusu boşdur!</b></center><hr style="border-top:1px dotted #f00;"/>';
}





if ($k_page > 1) {
echo str(''.$url.'/mail/index.php?id='.$id.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;',$k_page,$page); 
echo '<hr/>';

}
}
echo '<a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div>';


}
require_once ('../foot.php');
?>