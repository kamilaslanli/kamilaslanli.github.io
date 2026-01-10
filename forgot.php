<?php
error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
@require_once("db.php");
@require_once("head.php");
echo '<title>Şifrə Bərpası</title>';

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d.m.Y - H:i');

$ref=rand(1111,9999);

print('<div class="line-menu">Şifrə Bərpası</div>
        <div class="menu3">');

        if(@!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            @$error.='* <font color="red">Email düzgün deyil</font><br/>';
                }


	if(isset($_POST['acar'])){
		if(strlen($_POST['acar'])<2){
			@$error.='* <font color="red">Gizli söz 2 simvoldan qısa ola bilməz!</font> <br/>';
		}

		if(empty($error)){


$e = $_POST['email'];
$a = $_POST['acar'];

$sql = mysql_query("SELECT * FROM `users` WHERE `mail`='$e' OR `acar`='$a' LIMIT 1");
while($k = mysql_fetch_row($sql)){

if($_POST['email'] == $k['5'] AND $_POST['acar'] == $k['7']){

echo 'Sizin E-mail: <b>'.$k[5].'</b><br/> Sizin Şifrəniz: <b>'.base64_decode($k[4]).'</b>';
} else {
echo '<font color="red">* Daxil etdiyiniz E-mail vəya Gizli söz düzgün deyil!</font><br/>';
}

}

$yoxla=@mysql_fetch_assoc(@mysql_query("select * from `users` where `mail`='".$e."'"));
if($yoxla['id']==0){
echo '<font color="red">* E-mail bazada tapilmadi!</font>';
}


echo '<hr/><a href="'.$url.'/forgot.php?ref='.$ref.'">&laquo; Şifrə Bərpası</a>';

		}else{
			print($error);
			print('<hr/><a href="'.$url.'/forgot.php?ref='.$ref.'">&laquo; Geri</a>');
		}
	}else{


		print('<form method="POST">
               E-mail: <br/>
		<input type="text" name="email"/><br>
                Gizli söz: <br/>
		<input type="text" name="acar"/><br>
		<input type="submit" value="GÖNDƏR"/>
		</form>');

                echo '<br/><div class="rmenu">Diqqət! Egər anketdə <u>email</u> ünvanı və <u>gizli söz</u> qeyd olunmayıbsa, o zaman siz şifrəni bərpa edə bilməyəcəksiniz.</div>';

	}

echo '</div>';


echo '<div class="menu3"><a href="index.php?home">&laquo; Ana səhifə</a></div>';

@require_once("foot.php");

?>