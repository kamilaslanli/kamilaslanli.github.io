<?php

date_default_timezone_set("Asia/Dubai");
$gunler = array(
'Bazar Ert&#601;si' ,
'&#199;&#601;r&#351;&#601;nb&#601; Ax&#351;am&#305;' ,
'&#199;&#601;r&#351;&#601;mb&#601;' ,
'C&#252;m&#601; Ax&#351;am&#305;' ,
'C&#252;m&#601; ' ,
'Ş&#601;nb&#601; ' ,
'Bazar'
);
$aylar = array (
'Yanvar' ,
'Fevral' ,
'Mart' ,
'Aprel' ,
'May' ,
'&#304;yun' ,
'&#304;yul' ,
'Avqust' ,
'Sentyabr' ,
'Oktyabr' ,
'Noyabr' ,
'Dekabr'
);
$ay = $aylar [date('m' ) - 1];
$gun = $gunler [ date('N' ) - 1];

echo "<center><font color=\"black\">";


echo "Bug&#252;n ". date('j ') .$ay .date(' Y ') .$gun ."<br/>";

echo "Saat ". date('H:i:s');

echo "</font></center>";

// kamil
?>