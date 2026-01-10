<?php
session_start();
@require_once("db.php");
@require_once("head.php");
echo '<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css">';
//echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">';
echo '<title>Yeni Qeydiyyat</title>';

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d/m/y - H:i');
$tarix = time();
$ref=rand(1111,9999);


if(empty($_GET['id']) or empty($_GET['ps'])){




print('<div class="line-menu">Qeydiyyat</div>
        <div class="menu3">');

	if(isset($_POST['user']) and isset($_POST['ps']) and isset($_POST['sex'])){
                  
                $_SESSION['save'] = array(
                'nick' => $_POST['user'],
                'uad' => $_POST['ad'],
                'pw' => $_POST['ps'],
                'ml' => $_POST['mail']);
                $dtarix = ''.htmlspecialchars(trim($_POST["gun"])).'-'.htmlspecialchars(trim($_POST["ay"])).'-'.htmlspecialchars(trim($_POST["il"])).'';


		if(mysql_result(mysql_query("select count(*) from `users` where `user`='".htmlspecialchars(trim($_POST['user']))."'"),0)!=0){
			$error.='* <font color="red">Oxşar login bazada tapıldı!</font><br/>';
		}

               if(mysql_result(mysql_query("select count(*) from `users` where `mail`='".htmlspecialchars(trim($_POST['mail']))."'"),0)!=0){
			$error.='* <font color="red">Daxil etdiyiniz e-mail daha once qeydiyyatdan kecib!</font><br/>';
		}



                if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            $error.='* <font color="red">Email düzgün deyil</font><br/>';
                }
		if(strlen($_POST['user'])>15 or strlen($_POST['user'])<3){
			$error.='* <font color="red">Login 15 simvoldan uzun və 3 simvoldan qısa ola bilməz!</font><br/>';
		}if(strlen($_POST['ps'])<4){
			$error.='* <font color="red">Şifrə 4 simvoldan qısa ola bilməz!</font> <br/>';
                 }if(strlen($_POST['ad'])<3){
                        $error.='* <font color="red">Ad 3 simvoldan qısa ola bilməz!</font> <br/>';
                 }if(strlen($_POST['acar'])<4){
			$error.='* <font color="red">Açar söz 4 simvoldan qısa ola bilməz!</font> <br/>';
		}if(intval($_POST['sex'])==1 or intval($_POST['sex'])==2){
			
		}else{
			$error.='* <font color="red">Cinsiyyət seçiminde səhv var!</font><br/>';
		}if($_POST['ps']==$_POST['user']){
			$error.='* <font color="red">Nik və şifrə eyni ola bilməz!</font><br/>';
		}
		if(empty($error)){
			mysql_query("insert into `users` set `ip`='".$_SERVER['REMOTE_ADDR']."',`soft`='".$_SERVER['HTTP_USER_AGENT']."',`sex`='".intval($_POST['sex'])."',`user`='".htmlspecialchars(trim($_POST['user']))."',`ad`='".htmlspecialchars(trim($_POST['ad']))."',`dtarix`='".$dtarix."',`mail`='".htmlspecialchars(trim($_POST['mail']))."',`reg_date`='".$vaxt."',`acar`='".htmlspecialchars(trim($_POST['acar']))."',`pass`='".base64_encode($_POST['ps'])."'");
			print('<b><font color="green">Qeydiyyat tamamlandı</font></b><br/>----<br/>
			&raquo; Sizin ID: <b>'.mysql_insert_id().'</b><br/>
			&raquo; Sizin Login: <b>'.$_POST['user'].'</b><br/>
			&raquo; Sizin Parol: <b>'.$_POST['ps'].'</b><br/>----<br/>
			<div class="auth2"><a href="index.php?id='.mysql_insert_id().'&ps='.base64_encode($_POST['ps']).'">Daxil ol</a></div>');

                        

@mysql_query("insert into `mesaj` set `uid`='2',`nik`='Sistem',`text`='[color=brown][b]".$_POST['user']."[/b] yeni qeyd oldu.[/color]',`vaxt`='".$tarix."'");





		}else{
			print($error);
			print('<hr/><a href="reg.php?ref='.$ref.'">&laquo; Geri</a>');
		}
	}else{

		print('<center><form method="POST">
		
                <div class="input-group" style="width:70%;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
		<input type="text" class="form-control" placeholder="Login" name="user" value="'.$_SESSION['save']['nick'].'"/>
                </div>

                <div class="input-group" style="width:70%;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		<input type="text" class="form-control" placeholder="Ad Soyad" name="ad" value="'.$_SESSION['save']['uad'].'"/>
                </div>

                 <div class="input-group" style="width:70%;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		<input type="text" class="form-control" placeholder="Parol" name="ps" value="'.$_SESSION['save']['pw'].'"/>
                </div>

                <div class="input-group" style="width:70%;">
                <span class="input-group-addon"><b>&#64;</b></span>
		<input type="text" class="form-control" placeholder="Email" name="mail" value="'.$_SESSION['save']['ml'].'"/>
                </div>





<div class="input-group" style="width:70%;">

 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

<select class="col-md-4 form-control" style="width:30%;" name="gun"><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>



<select class="col-md-4 form-control"  style="width:40%;" name="ay"><option value="01">Yanvar</option><option value="02">Fevral</option><option value="03">Mart</option><option value="04">Aprel</option><option value="05">May</option><option value="06">&#304;yun</option><option value="07">&#304;yul</option><option value="08">Avqust</option><option value="09">Sentyabr</option><option value="10">Oktyabr</option><option value="11">Noyabr</option><option value="12">Dekabr</option></select>



<select class="col-md-4 form-control"  style="width:30%;" name="il" value="1994"><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option></select>

</div>






                <div class="input-group" style="width:70%;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
		<input type="text" class="form-control" placeholder="Gizli soz" name="acar" value="'.$_SESSION['save']['ac'].'"/>
                </div>

		<div class="input-group" style="width:70%;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign"></i></span>
		<select class="form-control" name="sex">
                <option value="sec">Sec</option>
		<option value="1">Kişi</option>
		<option value="2">Qadın</option>
		</select>
                </div>

		<input type="submit" class="form-control" style="width:70%;" value="Qeyd Ol"/></center>');
	}

echo '</div>';






echo '<div class="menu3"><a href="index.php?home">&laquo; Ana səhifə</a></div>';

}

@require_once("foot.php");

?>