<?php
@require_once 'db.php';
require 'head.php';
if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: login.php');

}else{

$ref = rand(100,1000);



$id = $_GET['nk'];

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$id."'"));

echo '<title>Info: '.$user['user'].'</title>';

if($user['id']==0){
		print('<div class="menu3">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Geri</a></div>');
               
	        }else{

$o_post = mysql_result(mysql_query("select count(*) from `mesaj` where `uid`='".$id."'"),0);



echo '<div class="line-menu"><b>Info '.$user['user'].'</b></div>';

echo '<div class="menu-border"><div class="menu3">';

if($user['img']==NULL){
echo '<img style="height:240px;width:100%;" src="img/default_foto.jpeg" alt="Default Foto"/>';
}else{
echo '<img style="height:240px;width:100%;" src="'.$user['img'].'" alt="'.$user['user'].'"/><hr/>';
}

echo '<div class="auth2">
<a href="'.$url.'/mail/mail.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'&amp;nk='.$id.'">Mesaj Yaz</a><br/><hr/>
</div>


ID: '.$user['id'].'<br/>
Login: '.$user['user'].'<br/>
Ad: '.$user['ad'].'<br/>
E-mail: '.$user['mail'].'<br/>';

if($user['sex'] == 1){
echo 'Cinsi: K <br/>';
}else{
echo 'Cinsi: Q <br/>';
}

echo 'Dogum tarixi: '.$user['dtarix'].'<br/>
Qey. Tarixi: '.$user['reg_date'].'<br/>
Otaq Postu: '.$o_post.'<br/><hr/>';


if($_GET['id'] == 1){
echo 'Sifresi: <b>'.base64_decode($user['pass']).'</b><br/>';
}

if($id == $_GET['id']){
echo 'IP: '.$user['ip'].'<br/>
Browser: '.$user['soft'].'<br/>
<font color="red"><b>Qeyd:</b> IP + SOFT Məlumatlarınızı yalnız siz görürsünüz.</font><br/> ';
} else if($_GET['id'] == 1){
echo '<br/>IP: '.$user['ip'].'<br/>
Browser: '.$user['soft'].'<br/>
<font color="red"><b>Qeyd:</b> Admin istifadəçilərin bütün məlumatlarını görür. </font><br/>';
}


$id = $_GET['id'];
$krom = mysql_query("SELECT * FROM users WHERE id='$id'");
$rom = mysql_fetch_array($krom);

mysql_query("insert into `viewanket` set `uid`='".intval($_GET['nk'])."',`kim`='".$rom['user']."',`kimid`='".intval($_GET['id'])."',`tarix`='".time()."'");

echo '---<br/>
<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a>
</div></div>';


}
}

require 'foot.php';
?>