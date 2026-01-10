<?php
require_once '../db.php';
require_once 'func.php';
require_once '../head.php';
echo '<title>Ses Gonder</title>';



echo '<div class="line-menu">Ses Gonder</div><div class="menu-border"><div class="menu3">';


$dizin = 'voice/';
$ses = $dizin . basename($_FILES['file']['name']['524122']);

$ad = $_FILES['tmp_name'][_58554454];
echo $ad;

if($_POST['submit']){

if (move_uploaded_file($_FILES['file']['tmp_name'], $ses))
{
    echo '<img src="tamam.jpg" width="100"><br>';
echo "Dosya başarıyla yüklendi.<br>";
 
} else {
    echo "Dosya yüklenemedi!\n";
}

}

echo '<form enctype="multipart/form-data" action=""  method="POST">
<input type="file" name="file" accept="audio/*" capture="microphone">
<input type="submit" name="submit" value="Gonder">
</form>';















echo '</div></div>';
require_once '../foot.php';
?>