<?php
session_start();
@require_once("db.php");
@require_once("./file/func.php");
@require_once("head.php");
$ref=rand(1111,9999);

                    
date_default_timezone_set("Asia/Dubai");
$vaxt = date('d/m/y - H:i');

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: login.php');

}else{

                    $kamil= $_GET['k'];
                    switch($kamil){
                    default:



$id = intval($_GET['fid']);
$k_id = intval($_GET['id']);

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".intval($_GET['id'])."' and `pass`='".htmlspecialchars($_GET['ps'])."'"));

if($user['id']==0){
print('<div class="menu3">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="/">Geri</a></div>');
} else {

echo  '<title>Online SMS</title>';
mysql_query("update `users` set `on`='".(time()+300)."' where `id`='".intval($_GET['id'])."'");
print('<div class="line-menu">Online SMS</div><div class="menu-border"><div class="menu3">');

if(isset($_POST['submit'])){
if(empty($_POST['text'])){
echo '* <font color="red">Mesajınızı daxil edin.</font><hr style="border-top:1px dotted #f00;"/>';
} else {

$k_sql =mysql_query("SELECT * FROM `o_sms` ORDER BY `id` DESC LIMIT 0,1");

while($k_row=mysql_fetch_array($k_sql))
    
        $time = $k_row['k_limit'];
        if($time > time()) {
        echo '<div class="rmenu">* Yeni SMS yazmaq ucun '.timeLeft($time).' gozlemelisiniz!</div>';


} else {       


 
$k_limit = strtotime('+30 minutes');

if(!empty($_POST['text']) and $_POST['token']==$_SESSION['token']){
if(mysql_result(mysql_query("select count(*) from `o_sms` where `uid`='".intval($_GET['id'])."' and `text`='".htmlspecialchars(trim($_POST['text']))."'"),0)==0){
mysql_query("insert into `o_sms` set `uid`='".$user['id']."',`nik`='".$user['user']."',`text`='".htmlspecialchars(trim($_POST['text']))."',`time`='".$vaxt."',`k_limit`='".$k_limit."'");
header("location: ".$_SERVER['HTTP_REFERER']."");
}else {
print('* <font color="red">Oxşar mesaj yazılıb!</font><hr style="border-top:1px dotted #f00;"/>');
}
}
}
}

}





if($_GET['go']=='temizle' and $user['id']==1){
		if($_GET['ok']==1){
			mysql_query("truncate table `o_sms`");
                        mysql_query("truncate table `comm`");
                        mysql_query("truncate table `smslike`");
			header("location: sms.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
		}
	print('&raquo; Smsleri temizlemek istediyinize eminsiniz ?<br/>
	[<a href="sms.php?id='.$_GET['id'].'&ps='.$_GET['ps'].'&go=temizle&ok=1&ref='.$ref.'">Beli</a>] | [<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Xeyr</a>]
	<br/>----<br/>');
}elseif($_GET['mdel']!=0 and $user['id']==1){
	mysql_query("delete from `o_sms` where `id`='".$_GET['mdel']."'");
	header("location: sms.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
}elseif($_GET['ndel']!=0 and $user['id']==1){
	if($_GET['ok']==1){
	//mysql_query("delete from `users` where `id`='".$_GET['ndel']."'");
	//mysql_query("delete from `mesaj` where `uid`='".$_GET['ndel']."'");
	//header("location: index.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
	}
	print('&raquo; <u><b>'.$_GET['nick'].'</b></u> -  nikini silmek istediyinize eminsiniz ?<br/>
	[<a href="?id='.$_GET['id'].'&ps='.$_GET['ps'].'&ndel='.$_GET['ndel'].'&ok=1&ref='.$ref.'">Beli</a>] | [<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Xeyr</a>]
	<br/>----<br/>');
}


$_SESSION['token']=md5(rand(11111111,999999999));

print('<form name="form" action="" method="post">Mesajınız:<br/>
<input type="text" name="text"><br/>
<input type="hidden" name="token" value="'.$_SESSION['token'].'"/>
<input type="submit" name="submit" value="YAZ" style="width:auto;"/>
</form><hr/>');

$all=mysql_result(mysql_query("select count(*) from `o_sms`"),0);

$allb = mysql_result(mysql_query("SELECT count(*) FROM `smslike` WHERE `smsid`='".$id."'"),0);


echo ''.($user['id']==1 ? '[<a href="?id='.$_GET['id'].'&ps='.$_GET['ps'].'&go=temizle&ref='.$ref.'">Temizle</a>] | ' : '').' <b>SMS`ler ('.$all.')</b> | [<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Yenilə</a>]</div><div class="menu3">';

if($all==0){
print('SMS yazan olmayib.<hr/>');
}else{

$page=(int)$_GET['page'];
if(empty($page)) $page=1;
$limit=10;
$sehife_s=ceil($all/$limit);
if($page>$sehife_s)$page=1;
$goster=$page*$limit-$limit;
$mesaj=mysql_query("select * from `o_sms` order by `id` desc limit $goster,$limit");
		
while($m=mysql_fetch_assoc($mesaj)){
			$i++;
                        $_SESSION['nik'] = $m['uid'];
                        $k_allf = mysql_num_rows(mysql_query("SELECT * FROM `comm` WHERE `mesaj_id`='".$m['id']."'"));
                        $k_allb = mysql_num_rows(mysql_query("SELECT * FROM `smslike` WHERE `smsid`='".$m['id']."'"));
			$userinf=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$m['uid']."'"));
			print('<img src="img/'.($userinf['sex']==1 ? 'men' : 'girl').'.png" alt="icon"/>
<b><a href="info.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nk='.$m['uid'].'">'.$m['nik'].'</a></b> <small>('.$m['time'].')</small>&raquo; 
			'.smi(bb_code($m['text'])).' (<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=like&b='.$m['id'].'&ref='.$ref.'">Beyen</a> <img src="img/beyen.png" alt="beyen"/> <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=kim&b='.$m['id'].'&ref='.$ref.'">'.$k_allb.'</a> &#8226; <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$m['id'].'&ref='.$ref.'">Fikir-'.$k_allf.'</a> <img src="img/fikir.png" alt="fikir"/>)<br/><div style="text-align:right;">'.($user['id']==1 ? ' <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&mdel='.$m['id'].'"><img src="img/del.png" alt="sil"/></a>':'').'</div><hr/>');
		}// while son



if($all>$limit){
print('<center>');
if($page>1){
print ('<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page-1).'">&laquo; Evvelki</a>');
}
if($page>1){
print(' | ');
}
if($page!=$sehife_s){
print ('<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page+1).'&ref='.$ref.'">Sonraki &raquo;</a>');
}
echo '<hr/></center>';
}

} //  if $all son
}  // user[id] son
echo '<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'">&laquo; Geri</a></div></div>';
















break;
case 'fikir':

$id = intval($_GET['fid']);
$k_id = intval($_GET['id']);

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".intval($_GET['id'])."' and `pass`='".htmlspecialchars($_GET['ps'])."'"));

if($user['id']==0){
print('<div class="menu3">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="/">Geri</a></div>');
} else {

echo  '<title>SMS Fikirler</title>';
mysql_query("update `users` set `on`='".(time()+300)."' where `id`='".intval($_GET['id'])."'");
print('<div class="line-menu">SMS Fikirler</div><div class="menu-border"><div class="menu3">');

$osms  = mysql_query("SELECT * FROM `o_sms` WHERE `id`='".$id."'");
while($k_row = mysql_fetch_array($osms)){
echo '<center><b>'.$k_row['nik'].' &raquo;</b> '.bb_code($k_row['text']).'</center><hr/>';
}

if(isset($_POST['submit'])){
if(empty($_POST['text'])){
echo '* <font color="red">Mesajınızı daxil edin.</font><hr style="border-top:1px dotted #f00;"/>';
} else {
if(!empty($_POST['text']) and $_POST['token']==$_SESSION['token']){
//if(mysql_result(mysql_query("select count(*) from `comm` where `uid`='".intval($_GET['id'])."' and `serh`='".htmlspecialchars(trim($_POST['text']))."'"),0)==0){
mysql_query("insert into `comm`  set  `mesaj_id`='".$id."',`uid`='".$user['id']."',`nik`='".$user['user']."',`serh`='".htmlspecialchars(trim($_POST['text']))."',`time`='".time()."'");
header("location: ".$_SERVER['HTTP_REFERER']."");
//}else {
//print('* <font color="red">Oxşar mesaj yazılıb!</font><hr style="border-top:1px dotted #f00;"/>');
//}
}
}
}


if($_GET['go']=='temizle' and $user['id']==1){
		if($_GET['ok']==1){
			mysql_query("truncate table `o_sms`");
			header("location: sms.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
		}
	print('&raquo; Fikirleri temizlemek istediyinize eminsiniz ?<br/>
	[<a href="sms.php?id='.$_GET['id'].'&ps='.$_GET['ps'].'&go=temizle&ok=1&ref='.$ref.'">Beli</a>] | [<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Xeyr</a>]
	<br/>----<br/>');
}elseif($_GET['mdel']!=0 and $user['id']==1){
	mysql_query("delete from `comm` where `id`='".$_GET['mdel']."'");
	header('location: sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$_GET['fid'].'');
}elseif($_GET['msil']!=0 and $user['id']==$_GET['id']){
	mysql_query("delete from `comm` where `id`='".$_GET['msil']."'");
	header('location: sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$_GET['fid'].'');
}


$_SESSION['token']=md5(rand(11111111,999999999));

print('<form name="form" action="" method="post">Mesajınız: (max. 300)<br/>
<input type="text" name="text"><br/>
<input type="hidden" name="token" value="'.$_SESSION['token'].'"/>
<input type="submit" name="submit" value="Göndər" style="width:auto;"/>
</form><hr/>');

$allf = mysql_result(mysql_query("SELECT count(*) FROM `comm` WHERE `mesaj_id`='".$id."'"),0);
$allb = mysql_result(mysql_query("SELECT count(*) FROM `smslike` WHERE `smsid`='".$id."'"),0);


echo '<b>Fikirler ('.$allf.')</b> | [<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$id.'&ref='.$ref.'">Yenilə</a>]<br>
<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=kim&b='.$_GET['fid'].'&ref='.$ref.'">Beyenenler ('.$allb.')</a></div><div class="menu3">';

if($allf==0){
print('Fikir bildiren olmayib.<hr/>');
}else{

$page=(int)$_GET['page'];
if(empty($page)) $page=1;
$limit=10;
$sehife_s=ceil($allf/$limit);
if($page>$sehife_s)$page=1;
$goster=$page*$limit-$limit;
$mesaj=mysql_query("select * from `comm` where `mesaj_id`='".$id."' order by `id` desc limit $goster,$limit");
		
while($m=mysql_fetch_assoc($mesaj)){
$i++;
$_SESSION['nik'] = $m['uid'];
$userinf=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$m['uid']."'"));
print('<img src="img/'.($userinf['sex']==1 ? 'men' : 'girl').'.png" alt="icon"/>
<b><a href="info.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nk='.$m['uid'].'">'.$m['nik'].'</a></b> <small>('.date('d/m/y - H:i', $m['time']).')</small>&raquo; '.$m['serh'].' '.($user['id']>1 ? ' '.($user['id']==$m['uid'] ? ' <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$_GET['fid'].'&msil='.$m['id'].'">[x]':'').' ':'').'<br/><div style="text-align:right;">'.($user['id']==1 ? ' <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$_GET['fid'].'&mdel='.$m['id'].'"><img src="img/del.png" alt="sil"/></a>':'').'</div><hr/>');
} // while son



if($allf>$limit){
print('<center>');
if($page>1){
print ('<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$id.'&page='.($page-1).'">&laquo; Evvelki</a>');
}
if($page>1){
print(' | ');
}
if($page!=$sehife_s){
print ('<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$id.'&page='.($page+1).'">Sonraki &raquo;</a>');
}
echo '<hr/></center>';
}

} //  if $allf son
}  // user[id] son
echo '<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'">&laquo; Online SMS</a><br/>
<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'">&laquo; Geri</a></div></div>';
break;

case 'like':

echo '<title>SMS Beyen</title>';

$id = intval($_GET['b']);
$k_id = intval($_GET['id']);

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".intval($_GET['id'])."' and `pass`='".htmlspecialchars($_GET['ps'])."'"));

if(mysql_result(mysql_query("select count(*) from `smslike` where `uid`='".$k_id."' and `smsid`='".$id."'"),0)==0){
mysql_query("insert into `smslike`  set  `smsid`='".$id."',`uid`='".$k_id."',`nik`='".$user['user']."',`time`='".time()."'");
header("location: ".$_SERVER['HTTP_REFERER']."");
}else {
print('<div class="menu-border"><div class="menu3">* <font color="red">Siz artiq bu SMS-i beyenmisiniz!</font><hr style="border-top:1px dotted #f00;"/><a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Online SMS</a><br/><a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div></div>');
}

break;








case 'kim':

echo '<title>SMS-i Beyenenler</title>';
echo '<div class="line-menu">SMS-i Beyenenler</div><div class="menu-border"><div class="menu3">';

$id = intval($_GET['b']);
$k_id = intval($_GET['id']);

$allb = mysql_result(mysql_query("SELECT count(*) FROM `smslike` WHERE `smsid`='".$id."'"),0);

if($allb==0){
print('SMS-i beyenen olmayib.<hr/>');
}else{
$page=(int)$_GET['page'];
if(empty($page)) $page=1;
$limit=10;
$sehife_s=ceil($allf/$limit);
if($page>$sehife_s)$page=1;
$goster=$page*$limit-$limit;
$like=mysql_query("select * from `smslike` where `smsid`='".$id."' order by `id` desc limit $goster,$limit");




$osms  = mysql_query("SELECT * FROM `o_sms` WHERE `id`='".$id."'");
while($k_row = mysql_fetch_array($osms)){
echo '<center><b>'.$k_row['nik'].' &raquo;</b> '.bb_code($k_row['text']).'</center><hr/>';
}

echo '<b>Beyenenler ('.$allb.')</b><br/>----<br/>';
		
while($m=mysql_fetch_assoc($like)){
$i++;
$_SESSION['nik'] = $m['uid'];
$userinf=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$m['uid']."'"));
print('<img src="img/'.($userinf['sex']==1 ? 'men' : 'girl').'.png" alt="icon"/>
<b><a href="info.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nk='.$m['uid'].'">'.$m['nik'].'</a></b> <small>('.date('d/m/y - H:i', $m['time']).')</small><div style="text-align:right;">'.($user['id']==1 ? ' <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&mdel='.$m['id'].'"><img src="img/del.png" alt="sil"/></a>':'').'</div><hr style="border-top:1px dotted #f00;"/>');
} // while son



if($allf>$limit){
print('<center>');
if($page>1){
print ('<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$id.'&page='.($page-1).'">&laquo; Evvelki</a>');
}
if($page>1){
print(' | ');
}
if($page!=$sehife_s){
print ('<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$id.'&page='.($page+1).'">Sonraki &raquo;</a>');
}
echo '</center>';
}
} // $allb son

echo '<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Online SMS</a><br/><a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a>';
echo '</div></div>';
break;

                    }   //switch() son
}
@require_once ("foot.php");



?>