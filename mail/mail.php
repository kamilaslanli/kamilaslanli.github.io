<?php
// K4M!L
session_start();
@require_once("../db.php");
@require_once("../head.php");
@require_once("../file/func.php");
$ref=rand(1111,9999);

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{

$id = $_GET['id'];
$nk = $_GET['nk'];
$mesaj = htmlspecialchars($_POST['text']);

$k = mysql_query("SELECT * FROM users WHERE id='$nk'");
$user = mysql_fetch_array($k);

$krom = mysql_query("SELECT * FROM users WHERE id='$id'");
$rom = mysql_fetch_array($krom);

$nik = mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".intval($_GET['id'])."' and `pass`='".htmlspecialchars($_GET['ps'])."'"));



echo '<title>Mesajlar: '.$user['user'].'</title>';


echo '<div class="line-menu">Login: '.$rom['user'].' </div><div class="menu-border"><div class="menu3">';




$mess = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$id."'"));

$messa = @mysql_result(@mysql_query("SELECT COUNT(id) FROM  `mail_list` WHERE `alan_id` = '".$mess['id']."' and `gonderen_id` = '".$user['id']."' LIMIT 1"),0);




if(isset($_POST['submit'])){
if(empty($_POST['text'])){
echo '<font color="red">* Mesaj daxil edin</font><hr style="border-top:1px dotted #f00;"/>';
} else if(@mysql_result(@mysql_query("select count(*) from `mail` where `mesaj`='".$mesaj."'"),0)!=0){
echo '<font color="red">* Oxşar mesaj yazılıb</font><hr style="border-top:1px dotted #f00;"/>';
} else if($user['user'] == $nik['user']){
echo '<font color="red">* Özün-özünə yaza bilməzsən!</font><hr style="border-top:1px dotted #f00;"/>';
} else {
mysql_query("INSERT INTO `mail_list` SET `alan_id` = '".$user['id']."', `gonderen_id` = '".$mess['id']."', `vaxt` = '".$vaxt."'");
//mysql_query("INSERT INTO `mail_list` SET `alan_id` = '".$mess['id']."', `gonderen_id` = '".$user['id']."', `vaxt` = '".$vaxt."'");
mysql_query("INSERT INTO `mail` SET `mesaj` = '".$mesaj."', `alan_id` = '".$user['id']."', `gonderen_id` = '".$mess['id']."', `vaxt` = '".$vaxt."', oxundu = '0'");

}

}




	print('Mesajınız:<br/>
        <form method="POST">
	<textarea name="text"></textarea><br/>
	<input type="submit" name="submit" value="Göndər" style="width:auto;"/>
        <a href="'.$url.'/mail/mail.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$nk.'&amp;ref='.$ref.'">Yenilə</a>
	</form></div>');



echo '<div style="text-align:left;" class="menu3"><b>Arxiv: '.$user['user'].'</b></b></div><div class="menu3">';



function div($a){
			if($a==1){
				return 'you';
			}elseif($a==2){
				return 'my';
			}elseif($a==3){
				return 'you';
			}elseif($a==4){
				return 'my';
			}elseif($a==5){
				return 'you';
			}elseif($a==6){
				return 'my';
			}elseif($a==7){
				return 'you';
			}elseif($a==8){
				return 'my';
			}elseif($a==9){
				return 'you';
			}elseif($a==10){
				return 'my';
			}
		}


function nick($nk){
    $users = @mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$nk."' LIMIT 1"));
    return (empty($users)?'[Nick Silinib]':'<b>'.$users['user'].'</b>');
}


if (empty($user['max'])) $user['max']=10;
$max = $user['max'];
$k_post = mysql_result(mysql_query("SELECT COUNT(id) FROM `mail` WHERE `alan_id` = '".$user['id']."' and `gonderen_id` = '".$mess['id']."' or `alan_id` = '".$mess['id']."' and `gonderen_id` = '".$user['id']."'"),0);
$k_page = k_page($k_post,$max);
$page = page($k_page);
$start = $max*$page-$max;


$msg = mysql_query("SELECT * FROM `mail` WHERE `alan_id` = '".$user['id']."' and `gonderen_id` = '".$mess['id']."' or `alan_id` = '".$mess['id']."' and `gonderen_id` = '".$user['id']."' ORDER BY `id` DESC LIMIT $start,$max");


if($_GET['mdel']!=0 and $rom['id']==1){

	mysql_query("delete from `mail` where `id`='".$_GET['mdel']."'");
	header("location: mail.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&nk=".$nk."&ref=$ref");
	}



while($list = @mysql_fetch_assoc($msg)){
$i++;



$userinf=@mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$list[gonderen_id]."'"));
			



echo '<div class="'.div($i).' sms">
<fieldset style="border-radius: 20px;"><legend>
<img src="'.$url.'/img/'.($userinf['sex']==1 ? 'men' : 'girl').'.png" alt="icon"/>

'.nick($list['gonderen_id']).'';

if($list['oxundu'] == 0)
{
echo ' [<font color="red">Oxunmayib</font>]'; 
}else{
echo ' [<font color="green">Oxundu</font>]';
}


echo '</legend>' .bb_code($list['mesaj']).'<br/><div style="text-align:right;">'.$list['vaxt'].'<br/>'.($rom['id']==1 ? ' <a href="mail.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nk='.$nk.'&mdel='.$list['id'].'"><img src="../img/del.png" title="Sil" alt="sil"/></a>' : '').'</div></fieldset></div><br/>';


if($user['id'] == $list['gonderen_id'])
{
mysql_query("UPDATE `mail` SET `oxundu` = '1' WHERE `id`='".$list['id']."' limit 1");
}
}
if($k_post < 1)
{
echo '<center>Mesaj yoxdur!</center>';
}
if ($k_page > 1) {
echo '<hr/>';
echo str(''.$url.'/mail/mail.php?id='.$id.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$nk.'&amp;',$k_page,$page); 
//echo str(''.$HOME.'/message/message.php?id='.$mess['id'].'/?',$k_page,$page);
}

echo '<hr style="border-top:1px dotted #f00;"/><a href="'.$url.'/index.php?id='.$id.'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;ref='.$ref.'">&laquo; Geri</a></div></div>';


}
@require_once ("../foot.php");

?>