<?php
require_once '../db.php';
require_once 'func.php';
require_once '../head.php';

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{
echo '<title>BB Kodlar</title>';
echo '<div class="line-menu">BB Kodlar</div>';

echo '
<div class="menu3">Foto<br /><textarea>[img='.$url.'/img.png]</textarea></div>
<div class="menu3"><a href="/">Link</a><br /><textarea>[url='.$url.']'.$my_site.'[/url]</textarea></div>
<div class="menu3"><b>Qalin</b><br /><textarea>[b]Metn[/b]</textarea></div>
<div class="menu3"><i>Kursiv</i><br /><textarea>[i]Metn[/i]</textarea></div>
<div class="menu3"><u>Alti xettli</u><br /><textarea>[u]Metn[/u]</textarea></div>
<div class="menu3"><s>Ustu xettli</s><br /><textarea>[s]Metn[/s]</textarea></div>
<div class="menu3"><span style="color: red">Reng</span><br /><textarea>[color=red]Istenilen reng[/color]</textarea></div>
';

echo '<div class="menu3"><a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div>';

}
require_once '../foot.php';
?>