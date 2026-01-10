<?php
include 'db.php';
include './file/func.php';
include 'head.php';
echo '<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css">';
if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: login.php');

}else{

$id = $_GET['id'];
$nk = $_GET['nk'];

$krom = mysql_query("SELECT * FROM users WHERE id='$id'");
$rom = mysql_fetch_array($krom);

echo '<title>Profil Sekili</title>';
echo '<div class="line-menu">Profil Sekili</div><div class="menu-border"><div class="menu3">';
// Max size PER file in KB
$max_file_size="3072";

// Max size for all files COMBINED in KB
$max_combined_size="3072";

//Maximum file uploades at one time
$file_uploads="1";

//The name of your website
$websitename = $my_site;

// Full browser accessable URL to where files are accessed. With trailing slash.
$full_url=$url.'/file/profil/';

// Path to store files on your server If this fails use $fullpath below. With trailing slash.
$folder="file/profil/";

// Use random file names? true=yes (recommended), false=use original file name.
// Random names will help prevent files being denied because a file with that name already exists.
$random_name=true;

// Types of files that are acceptiable for uploading. Keep the array structure.
$allow_types=array("gif","jpg","jpeg","png");

// Only use this variable if you wish to use full server paths. Otherwise leave this empty. With trailing slash.
$fullpath="";

//Use this only if you want to password protect your upload form.
$password=""; 

/*
//================================================================================
* ! ATTENTION !
//================================================================================
: Don't edit below this line.
*/

// Initialize variables
$password_hash=md5($password);
$error="";
$success="";
$display_message="";
$file_ext=array();
$password_form="";

// Function to get the extension a file.
function get_ext($key) { 
	$key=strtolower(substr(strrchr($key, "."), 1));
	$key=str_replace("jpeg","jpg",$key);
	return $key;
}

// Filename security cleaning. Do not modify.
function cln_file_name($string) {
	$cln_filename_find=array("/\.[^\.]+$/", "/[^\d\w\s-]/", "/\s\s+/", "/[-]+/", "/[_]+/");
	$cln_filename_repl=array("", ""," ", "-", "_");
	$string=preg_replace($cln_filename_find, $cln_filename_repl, $string);
	return trim($string);
}

// If a password is set, they must login to upload files.
If($password) {
	
	//Verify the credentials.
	If($_POST['verify_password']==true) {
		If(md5($_POST['check_password'])==$password_hash) {
			setcookie("phUploader",$password_hash);
			sleep(1); //seems to help some people.
			header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
			exit;
		}
	}

	//Show the authentication form
	If($_COOKIE['phUploader']!=$password_hash) {
		$password_form="<form method=\"POST\" action=\"\">\n";
		$password_form.="<table align=\"center\" class=\"table\">\n";
		$password_form.="<tr>\n";
		$password_form.="<td width=\"100%\" class=\"table_header\" colspan=\"2\">Kod qoyulub</td>\n";
		$password_form.="</tr>\n";
		$password_form.="<tr>\n";
		$password_form.="<td width=\"35%\" class=\"table_body\">Kodu daxil et:</td>\n";
		$password_form.="<td width=\"65%\" class=\"table_body\"><input type=\"password\" name=\"check_password\" /></td>\n";
		$password_form.="</tr>\n";
		$password_form.="<td colspan=\"2\" align=\"center\" class=\"table_body\">\n";
		$password_form.="<input type=\"hidden\" name=\"verify_password\" value=\"true\">\n";
		$password_form.="<input type=\"submit\" value=\" Verify Password \" />\n";
		$password_form.="</td>\n";
		$password_form.="</tr>\n";
		$password_form.="</table>\n";
		$password_form.="</form>\n";
	}
	
} // If Password

// Dont allow submit if $password_form has been populated
If(($_POST['submit']==true) AND ($password_form=="")) {

	//Tally the size of all the files uploaded, check if it's over the ammount.	
	If(array_sum($_FILES['file']['size']) > $max_combined_size*1024) {
		
		$error.="<b>Sehv:</b> Butun fayllar <b>Sebeb:</b> Fayllarin yaddasi choxdur.<br />";
		
	// Loop though, verify and upload files.
	} Else {

		// Loop through all the files.
		For($i=0; $i <= $file_uploads-1; $i++) {
			
			// If a file actually exists in this key
			If($_FILES['file']['name'][$i]) {

				//Get the file extension
				$file_ext[$i]=get_ext($_FILES['file']['name'][$i]);
				
				// Randomize file names
				If($random_name){
					$file_name[$i]=time()+rand(0,100000).'_ROM';
				} Else {
					$file_name[$i]=cln_file_name($_FILES['file']['name'][$i]);
				}
	
				// Check for blank file name
				If(str_replace(" ", "", $file_name[$i])=="") {
					
					$error.= "<b>Sehv:</b> ".$_FILES['file']['name'][$i]." <b>Sebeb:</b> Faylin adi yazilmayib.<br />";
				
				//Check if the file type uploaded is a valid file type. 
				}	ElseIf(!in_array($file_ext[$i], $allow_types)) {
								
					$error.= "<b>Sehv:</b> ".$_FILES['file']['name'][$i]." <b>Sebeb:</b> Sehv fayl tipi.<br />";
								
				//Check the size of each file
				} Elseif($_FILES['file']['size'][$i] > ($max_file_size*1024)) {
					
					$error.= "<b>Sehv:</b> ".$_FILES['file']['name'][$i]." <b>Sebeb:</b> Fayl chox boyukdur.<br />";
					
				// Check if the file already exists on the server..
				} Elseif(file_exists($folder.$file_name[$i].".".$file_ext[$i])) {
	
					$error.= "<b>Sehv:</b> ".$_FILES['file']['name'][$i]." <b>Sebeb:</b> Fayl bazada var.<br />";
					
				} Else {
					
					If(move_uploaded_file($_FILES['file']['tmp_name'][$i],$folder.$file_name[$i].".".$file_ext[$i])) {

                                                

                        mysql_query("UPDATE `users` set `img`='".$full_url.$file_name[$i].".".$file_ext[$i]."' WHERE `id`='".$rom[id]."'");
					
	
				               
$success.="<center><a href=\"".$full_url.$file_name[$i].".".$file_ext[$i]."\" target=\"_blank\"><img src=\"".$full_url.$file_name[$i].".".$file_ext[$i]."\" height=\"240\" width=\"240\"></a></center><br />";
 $success.="<center><b>Profil sekili:</b> ".$_FILES['file']['name'][$i]."</center><br />";
						
					} Else {
						$error.="<b>Sehv:</b> ".$_FILES['file']['name'][$i]." <b>Sebeb:</b> Yuklemelerde sehflik var.<br />";
					}
					
				}
							
			} // If Files
		
		} // For
		
	} // Else Total Size
	
	If(($error=="") AND ($success=="")) {
		$error.="<b>Sehv:</b> Fayl sechilmeyib<br />";
	}

	$display_message=$success.$error;

} // $_POST AND !$password_form

/*
//================================================================================
* Start the form layout
//================================================================================
:- Please know what your doing before editing below. Sorry for the stop and start php.. people requested that I use only html for the form..
*/

If($password_form) {
	
	Echo $password_form;

} Else {
?>

<form action="" method="post" enctype="multipart/form-data" name="phuploader">
<table align="center" class="table">
<tr>
	</tr>
	
	<?If($display_message){?>
	<tr>
		<td colspan="2" class="message">
		<br />
			<?=$display_message;?>
		<br />
		</td>
	</tr>
	<?}?>
	

			<!--<b>Desteklenen Tipler:</b> <?=implode($allow_types, ", ");?><br />
			<b>Max. Desteklenen Ol&#231;u:</b> <?=$max_file_size?>KB / 3MB<br />
			<b>Max. Y&#252;kl&#601;m&#601; H&#601;cmi:</b> <?=$max_combined_size?>KB / 3MB<br />-->
<hr/>


<?  
if($_GET['foto']=='sil'){
mysql_query("UPDATE `users` set `img`='' WHERE `id`='".$rom[id]."'");
header('location: profil_img.php?id='.$_GET['id'].'&ps='.$_GET['ps'].'');
}

if($rom['img'] == NULL){
echo '<center><img src="img/default_foto.jpeg" height="240" width="240" alt="Default Foto"><br /></center><hr/>';
}else{
echo '<center><img src="'.$rom['img'].'" height="240" width="240" alt="'.$rom['user'].'"><br /><hr/><a href="profil_img.php?id='.$_GET['id'].'&ps='.$_GET['ps'].'&foto=sil">SiL</a></center><hr/>';
}
?>




		
	<?For($i=0;$i <= $file_uploads-1;$i++) {?>
               <div class="input-group">
                <span class="input-group-addon">
		<input  type="reset" name="reset" value="X" onclick="window.location.reload(true);" style="width:auto;"/> 
                 </span>
		<input class="form-control input-lg" type="file" name="file[]" accept="image/*"/>
		
	<?}?>
	                 <span class="input-group-addon">
			<input type="hidden" name="submit" value="true" />
			<input type="submit" value="Elave Et" style="width:auto;"/>
			</span>
                      </div>

</form>

<?}//Please leave this here.. it really dosen't make people hate you or make your site look bad.. ?>



<table class="table" style="border:0px;" align="center">
	<tr>
		<td></td>
	</tr>
<tr><td colspan="2" class="upload_info" align="center"></td></tr>
</table>

<?
echo '<hr/><a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a>';
 } 
?>

</div></div>
<? include 'foot.php'; ?>
