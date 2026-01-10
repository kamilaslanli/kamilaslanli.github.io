<?php
@require_once("db.php");
@require_once("head.php");
echo '<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css">';
echo '<title>'.$my_site.' xoş gəlmisiniz</title>';

$ref=rand(1111,9999);


if(empty($_GET['id']) or empty($_GET['ps'])){

echo '<div class="line-menu">Söhbət Otağı</div><div class="menu-border"><div class="menu3">';



@require_once("file/vaxt.php");
echo '<hr/>';


$all = @mysql_result(mysql_query("select count(*) from `users` where `on`>".time().""),0);

print('<center>Online: <b>'.$all.'</b> nəfər<hr/></center>');



if(!empty($_POST['user']) and !empty($_POST['ps'])){
	$idv=mysql_fetch_assoc(mysql_query("select * from `users` where 
	`user`='".htmlspecialchars(trim($_POST['user']))."' and
	`pass`='".base64_encode($_POST['ps'])."'
	"));


	if($idv['id']==0){
		header("location: index.php?id=".$_POST['user']."&ps=".base64_encode($_POST['ps'])."");
	}else{
		header("location: index.php?id=".$idv['id']."&ps=".base64_encode($_POST['ps'])."");
	}
}



if(isset($_POST['user']) || isset($_POST['ps'])) {
echo '<center><font color="red">Login veya Parol daxil edin</font></center><hr style="border-top:1px dotted #f00;"/>';
}

/*
<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		<input type="text" class="form-control input-lg" style="width:50%;" placeholder="Login" name="user" value="'.$_SESSION['save']['nick'].'"/><br>
                </div>
*/

print ('<center><form method="POST">');
	
	print('<div class="input-group" style="width:70%;">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	<input type="text" class="form-control" name="user" placeholder="Login"/></div> ');
	
        
	print('<div class="input-group" style="width:70%;">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	<input type="password" class="form-control" name="ps" placeholder="Parol"/></div>');
	
	print('<input class="btn btn-def btn-block" style="width:70%;" type="submit" value="DAXİL OL"/></center>');

echo '<hr/><p><center><var>Hesabin yoxdur? <a href="reg.php?ref='.$ref.'"><b><font color="128c7e">Qeydiyyatdan</font></b></a> kec. </var></center></p>';


echo '<hr/><center>';
$reg=@mysql_query("select * from `users`  order by id desc limit 1");
while($r=@mysql_fetch_array($reg)){
echo 'Yeni istifadəçi: <b><i>'.$r['user'].'</i></b><br/>';
}

echo 'Cəmi qeydiyyat: <b>'.@mysql_result(mysql_query("select count(*) from `users`"),0).'</b><br/>
Oğlanlar: <b>'.@mysql_result(@mysql_query("select count(*) from `users` where `sex`='1'"),0).'</b> | Qızlar: <b>'.@mysql_result(mysql_query("select count(*) from `users` where `sex`='2'"),0).'</b><hr/>Müəllif: <b>P4M3R4IK</b><br/>MOD: <img src="img/mod.png" height="14" width="88" alt="mod"/></center>';


}

echo '</div></div>';
@require_once ("foot.php");
?>