<?php
session_start();
@require_once("../db.php");
@require_once("../head.php");
echo '<title>Yeni Qeydiyyat</title>';

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d/m/y - H:i');

$ref=rand(1111,9999);


if(empty($_GET['id']) or empty($_GET['ps'])){




print('<div class="line-menu">Sürətli Qeydiyyat</div>
        <div class="menu3">');

	if(isset($_POST['user']) and isset($_POST['ps']) and isset($_POST['sex'])){
                  
                $_SESSION['save'] = array(
                'nick' => $_POST['user'],
                'uad' => $_POST['ad'],
                'pw' => $_POST['ps'],
                'ml' => $_POST['mail']);

		if(mysql_result(mysql_query("select count(*) from `users` where `user`='".htmlspecialchars(trim($_POST['user']))."'"),0)!=0){
			$error.='* <font color="red">Oxşar nick bazada tapıldı!</font><br/>';
		}

		if(strlen($_POST['user'])>15 or strlen($_POST['user'])<3){
			$error.='* <font color="red">Nik 15 simvoldan uzun və  3 simvoldan qısa ola bilməz!</font><br/>';
		}if(strlen($_POST['ps'])<4){
			$error.='* <font color="red">Şifrə 4 simvoldan qısa ola bilməz!</font> <br/>';
                
		}if(intval($_POST['sex'])==1 or intval($_POST['sex'])==2){
			
		}else{
			$error.='* <font color="red">Cinsiyyət seçiminde səhv var!</font><br/>';
		}if($_POST['ps']==$_POST['user']){
			$error.='* <font color="red">Nik və şifrə eyni ola bilməz!</font><br/>';
		}
		if(empty($error)){
			mysql_query("insert into `users` set `ip`='".$_SERVER['REMOTE_ADDR']."',`soft`='".$_SERVER['HTTP_USER_AGENT']."',`sex`='".intval($_POST['sex'])."',`user`='".htmlspecialchars(trim($_POST['user']))."',`ad`='-----',`mail`='-----',`reg_date`='".$vaxt."',`acar`='-----',`pass`='".base64_encode($_POST['ps'])."'");
			print('<b><font color="green">Qeydiyyat tamamlandı</font></b><br/>----<br/>
			&raquo; Sizin ID: <b>'.mysql_insert_id().'</b><br/>
			&raquo; Sizin Nik: <b>'.$_POST['user'].'</b><br/>
			&raquo; Sizin Parol: <b>'.$_POST['ps'].'</b><br/>----<br/>
			<div class="auth2"><a href="'.$url.'/index.php?id='.mysql_insert_id().'&ps='.base64_encode($_POST['ps']).'">Daxil OL</a></div>');

                        


mysql_query("insert into `mail` set `alan_id`='".mysql_insert_id()."',`gonderen_id`='2',`mesaj`='Siz süretli qeydiyyatdan keçdiniz, sonradan şifrə bərpası üçün anketinizi dəyişməyi unutmayın',`vaxt`='".$vaxt."',`oxundu`='0'");

mysql_query("insert into `mesaj` set `uid`='2',`nik`='Sistem',`text`='[color=brown][b]".$_POST['user']."[/b] nikli istifadəçi yeni qeyd oldu.[/color]',`vaxt`='".$vaxt."'");



		}else{
			print($error);
			print('<br/><a href="fast.php?ref='.$ref.'">&laquo; Geri</a>');
		}
	}else{






		print('<form method="POST">
		Nick:<br/>
		<input type="text" name="user" value="'.$_SESSION['save']['nick'].'"/><br>
		Parol:<br/>
		<input type="text" name="ps" value="'.$_SESSION['save']['pw'].'"/><br/>
		Cinsiniz:<br/>
		<select name="sex">
		<option value="1">Kişi</option>
		<option value="2">Qadın</option>
		</select><br/>----<br/>
		<input type="submit" value="Qeyd OL"/>
		</form>');
	}

echo '</div>';






echo '<div class="menu3"><a href="/?home">&laquo; Ana səhifə</a></div>';

}

@require_once("../foot.php");

?>