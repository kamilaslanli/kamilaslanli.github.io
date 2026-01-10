<?php
@require_once '../db.php';
require '../head.php';
echo '<title>Profil</title>';
if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: ../login.php');

}else{

$ref = rand(100,1000);



$id = $_GET['id'];

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$id."'"));

$alluser = @mysql_result(@mysql_query("select count(*) from `users`"),0);


if($user['id']==0){
		print('<div class="menu3">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="/">Geri</a></div>');
                
	        }else{

$o_post = mysql_result(mysql_query("select count(*) from `mesaj` where `uid`='".$id."'"),0);

echo '<div class="line-menu"><b>Info '.$user['user'].'</b></div>';

echo '<div class="menu-border"><div class="menu3">
ID: '.$user['id'].'<br/>
Login: '.$user['user'].'<br/>
Ad: '.$user['ad'].'<br/>
E-mail: '.$user['mail'].'<br/>';

if($user['sex'] == 1){
echo 'Cinsi: K <br/>';
}else{
echo 'Cinsi: Q <br/>';
}

echo 'Dogum Tarixi: '.$user['dtarix'].'<br/>
Qey. Tarixi: '.$user['reg_date'].'<br/>
Otaq Postu: '.$o_post.'<br/>';

$son=mysql_query("SELECT * FROM `users` ORDER BY id DESC LIMIT 1");
while($r=mysql_fetch_assoc($son)){
$k4[]=$r['user'];
echo 'Yeni istifadəçi: '.$k4[0].'<br/><hr/>

<a href="'.$url.'/file/arxiv.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">Arxiv Mesajlar</a><br/>
<a href="'.$url.'/file/edit.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">Anketi Deyis</a><br/>
<a href="'.$url.'/profil_img.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">Profil Sekili</a><br/>
<a href="'.$url.'/file/alluser.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">İstifadəçilər</a> ('.$alluser.')<br/>
<a href="'.$url.'/file/bb.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">BB Kodlar</a><br/>
<a href="'.$url.'/file/smile.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">Smaylikler</a><br/>';

$sexsi = mysql_result(mysql_query("select count(*) from `mail`"),0);
$umumi = mysql_result(mysql_query("select count(*) from `mesaj`"),0);
$osms = mysql_result(mysql_query("select count(*) from `o_sms`"),0);
$us = mysql_result(mysql_query("select count(*) from `users`"),0);
$serh = mysql_result(mysql_query("select count(*) from `comm`"),0);
$beyen = mysql_result(mysql_query("select count(*) from `smslike`"),0);
$qonaq = mysql_result(mysql_query("select count(*) from `viewanket`"),0);

if($_GET['id'] == 1){
echo '<a href="'.$url.'/admin/boot.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'">Bot User</a><br/>';
}
echo '<a href="'.$url.'/">Çıxış</a><br>


<hr/>
<b>Chat Statistikası</b> <br />
Cemi sexsi mesajlar: '.$sexsi.' <br />
Cemi umumi mesajlar: '.$umumi.' <br />
Cemi istifadeciler: '.$us.' <br />
Cemi online sms`ler: '.$osms.' <br />
Cemi sms fikirler: '.$serh.' <br />
Cemi sms beyenenler: '.$beyen.' <br />
Cemi qonaqlar: '.$qonaq.' <br />
<hr/>';
}


if($id == $_GET['id']){
echo 'IP: '.$user['ip'].'<br/>
Browser: '.$user['soft'].'<br/>
<font color="red"><b>Qeyd:</b> IP + SOFT Melumatlarinizi yalniz siz gorursunuz.</font><br/> ';
} else if($_GET['id'] == 1){
echo 'IP: '.$user['ip'].'<br/>
Browser: '.$user['soft'].'<br/>
<font color="red"><b>Qeyd:</b> Admin istifadecilerin butun melumatlarini gorur. </font><br/> ';
}

echo '---<br/>
<a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a>
</div></div>';


}


}

require '../foot.php';


?>