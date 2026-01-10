<?php
session_start();
@require_once("../db.php");
@require_once("../head.php");
echo '<title>BOT User</title>';

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d/m/y - H:i');
$tarix = time();
$ref=rand(1111,9999);


if(empty($_GET['id']) or empty($_GET['ps'])){

header ('location: ../login.php');

}else{


$gun = rand(10,31);
$ay= rand(1,12);
$il= rand(1960,2003);
$rand = $gun.'&#045;'.$ay.'&#045;'.$il;

if($_GET['id'] == 1){

print('<div class="line-menu">Bot User Elava et</div>
        <div class="menu3">');

	if(isset($_POST['user']) and isset($_POST['sex'])){
                  

		if(mysql_result(mysql_query("select count(*) from `users` where `user`='".htmlspecialchars(trim($_POST['user']))."'"),0)!=0){
			$error.='* <font color="red">Oxşar nick bazada tapıldı!</font><br/>';
		}

		if(strlen($_POST['user'])>20 or strlen($_POST['user'])<3){
			$error.='* <font color="red">Nik 20 simvoldan uzun və  3 simvoldan qısa ola bilməz!</font><br/>';
                
		}if(intval($_POST['sex'])==1 or intval($_POST['sex'])==2){
			
		}else{
			$error.='* <font color="red">Cinsiyyət seçiminde səhv var!</font><br/>';
		}if($_POST['ps']==$_POST['user']){
			$error.='* <font color="red">Nik və şifrə eyni ola bilməz!</font><br/>';
		}

		if(empty($error)){
			mysql_query("insert into `users` set `ip`='Bot_IP',`soft`='Bot_AGENT',`sex`='".intval($_POST['sex'])."',`user`='".htmlspecialchars(trim($_POST['user']))."',`ad`='-----',`dtarix`='".$rand."',`mail`='-----',`reg_date`='".$vaxt."',`acar`='-----',`pass`='".base64_encode($ref)."'");
			print('<b><font color="green">Bot User Elave Olundu</font></b><br/>----<br/>
			&raquo; ID: <b>'.mysql_insert_id().'</b><br/>
			&raquo; Nik: <b>'.$_POST['user'].'</b><br/>
			&raquo; Parol: <b>'.$ref.'</b><br/>----<br/>
		<a href="boot.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Bot User</a>');

                        

mysql_query("insert into `mesaj` set `uid`='2',`nik`='Sistem',`text`='[color=brown][b]".$_POST['user']."[/b] yeni qeyd oldu.[/color]',`vaxt`='".$tarix."'");



		}else{
			print($error);
			print('<br/><a href="boot.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Bot User</a>');
		}
	}else{






		print('<form method="POST">
		Nick:<br/>
		<input type="text" name="user"><br>
		Cinsi:<br/>
		<select name="sex">
		<option value="1">Kişi</option>
		<option value="2">Qadın</option>
		</select><br/>----<br/>
		<input type="submit" value="ELAVE ET"/>
		</form>');
	}

echo '</div>';



} else { 
echo '<div class="menu3" style="font-weight:bold;text-align:center;color:red;">Sizin bura giris huququnuz yoxdur!</div>';
}


echo '<div class="menu3"><a href="../index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Ana səhifə</a></div>';

}

@require_once("../foot.php");

?>