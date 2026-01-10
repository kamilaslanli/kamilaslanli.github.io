<?php

@require_once("../db.php");
@require_once("../head.php");
echo '<title>Mesaji Deyis</title>';

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d/m/y - H:i');

$ref=rand(1111,9999);


if(empty($_GET['id']) or empty($_GET['ps'])){

header ('location: ../login.php');

}else{

if($_GET['id'] == 1){



print('<div class="line-menu">Mesaji Deyis</div><div class="menu-border"><div class="menu3">');


$old = mysql_query("SELECT * FROM `mesaj` WHERE `id`='".$_GET[edit]."'");
$row=@mysql_fetch_array($old);


if(isset($_POST['submit'])){

if(empty($_POST['text'])){

             echo '* <font color="red">Mesajınızı daxil edin.</font><hr style="border-top:1px dotted #f00;"/>';
} else {

	   
		mysql_query("UPDATE `mesaj` SET `text`='".htmlspecialchars(trim($_POST['text']))."' WHERE `id`='".$_GET['edit']."'");
		header("location: ".$_SERVER['HTTP_REFERER']."");
	
}

}



echo '<form name="form" action="" method="post"><textarea name="text">'.$row['text'].'</textarea><br/>
	<input type="submit" name="submit" value="Deyis" style="width:auto;"/>
	</form>';









} else { 
echo '<div class="menu3" style="font-weight:bold;text-align:center;color:red;">Sizin bura giris huququnuz yoxdur!</div>';
}

}

echo '</div><div class="menu3"><a href="../index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Ana səhifə</a></div></div>';

@require_once("../foot.php");
?>