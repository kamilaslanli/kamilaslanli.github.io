<?php
include 'db.php';
include './file/func.php';
include 'head.php';
echo '<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css">';
if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: login.php');

}else{


$kamil= $_GET['act'];
switch($kamil){
default:



$id = $_GET['id'];
$nk = $_GET['nk'];

$krom = mysql_query("SELECT * FROM users WHERE id='$id'");
$rom = mysql_fetch_array($krom);



break;
case 'video':

$id = $_GET['id'];
$nk = $_GET['nk'];

$krom = mysql_query("SELECT * FROM users WHERE id='$id'");
$rom = mysql_fetch_array($krom);


break;

?>