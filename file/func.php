<?php
// K4M!L

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d.m.Y - H:i');


function bb_code($text) {
// Mo0N
//qalin metn
$text=preg_replace('/\[b\](.+)\[\/b\]/sU' , '<b>\1</b>', $text);
//alt setir
$text=preg_replace('/\[br\]/sU' , '</br>', $text);
//eyri metn
$text=preg_replace('/\[i\](.+)\[\/i\]/sU', '<i>\1</i>', $text);
//alti xettli metn
$text=preg_replace('/\[u\](.+)\[\/u\]/sU', '<u>\1</u>', $text);
//ustu xettli metn
$text=preg_replace('/\[s\](.+)\[\/s\]/sU', '<s>\1</s>', $text);
//link
$text = preg_replace('#\[url=(.*?)\](.*?)\[/url\]#si', '<a href="\1" target="_blank">\2</a>', $text);
$text=preg_replace('/\[url\](.+)\[\/url\]/sU', '<a href="http://\1" target="_blank">\1</a>', $text);
//foto
$text = preg_replace('#\[img=(.*?)\]#si', '<img src="timthumb.php?src=\1&w=200&h=200&q=30"/">', $text);
$text = preg_replace('#\[foto=(.*?)\]#si', '<img src="\1"/ style="width: 150px; height: 150px;">', $text);
//reng secimi
$text = preg_replace('#\[color=(.*?)\](.*?)\[/color\]#si', '<font color="\1">\2</font>', $text);
//arxa fon
$text = preg_replace('#\[bg=(.*?)\](.*?)\[/bg\]#si', '<span style="background:\1">\2</span>', $text);
//ses
$text = preg_replace('#\[audio=(.*?)\](.*?)\[/audio\]#si', '<audio style="max-width:240px;" controls><source type="audio/mpeg" src="\1">Your browser does not support the audio element.\2</audio>', $text);
$text=preg_replace('/\[audio\](.+)\[\/audio\]/sU', '<audio style="max-width:240px;" controls><source type="audio/mpeg" src="\1">Your browser does not support the audio element.\1</audio>', $text);
//video
$text = preg_replace('#\[vid=(.*?)\](.*?)\[/vid\]#si', '<video style="max-width:240px;" controls><source type="video/mp4" src="\1">Your browser does not support the video element.\2</video>', $text);
$text=preg_replace('/\[vid\](.+)\[\/vid\]/sU', '<video style="max-width:240px;" controls><source type="video/mp4" src="\1">Your browser does not support the video element.\1</video>', $text);
return $text; 
}



function text($var)
{
return htmlspecialchars($var, ENT_QUOTES, 'utf-8');
}
function check($check){
	$check = htmlspecialchars(mysql_real_escape_string($check));
	
	$search = array('|', '\'', '$', '\\', '^', '%', '`', "\0", "\x00", "\x1A", "‮⁄⁪⁫⁬∩");
	$replace = array('&#124;', '&#39;', '&#36;', '&#92;', '&#94;', '&#37;', '&#96;', '', '', '', '');
	$msg = str_replace($search, $replace, $msg);
	
	$msg = stripslashes(trim($msg));
	return $check;
}




function page($k_page=1) {
$page = 1;
$page = text($page);
$k_page = text($k_page);
if(isset($_GET['selection'])) {
if ($_GET['selection']=='top')
$page = text(intval($k_page));
elseif(is_numeric($_GET['selection'])) 
$page = text(intval($_GET['selection']));
}
if ($page<1)$page=1;
if ($page>$k_page)$page=$k_page;
return $page;
}
function k_page($k_post = 0,$k_p_str = 10) {
if ($k_post != 0) {
$v_pages = ceil($k_post/$k_p_str);
return $v_pages;
}
else return 1;
}



function str($link='?',$k_page=1,$page=1){
if ($page<1)$page=1;
$page = text($page);
$k_page = text($k_page);


if ($page != 1)
echo 'Seh: <a href="'.$link.'selection=1" >1</a>';
else echo 'Seh: <b>1</b>';
for ($ot=-3; $ot<=3; $ot++){
if ($page+$ot>1 && $page+$ot<$k_page){
if ($ot==-3 && $page+$ot>2)echo " ..";
if ($ot!=0)echo '|<a href="'.$link.'selection='.($page+$ot).'" >'.($page+$ot).'</a>';
else echo '|<b>'.($page+$ot).'</b>';
if ($ot==3 && $page+$ot<$k_page-1)echo "|..";}}
if ($page!=$k_page)echo '|<a href="'.$link.'selection=top" >'.$k_page.'</a>';
elseif ($k_page>1)echo '|<b>'.$k_page.'</b>';
}

function times($var)
{
if ($var == NULL) $var = time();
$full_time = date('d.m.Y в H:i', $var);
$date = date('d.m.Y', $var);
$time = date('H:i', $var);
if ($date == date('d.m.Y'))
$full_time = date('Bugun H:i', $var);
if ($date == date('d.m.Y', time()-60*60*24))
$full_time = date('Dunen H:i', $var);
return $full_time;
}

function smi($text)
{
$text = strtr($text, array(
'.aa.'=>'<img src="smile/aaa.gif"/>',
'.ah.'=>'<img src="smile/ah.gif"/>',
'.bla.'=>'<img src="smile/blabla.gif"/>',
'.bro.'=>'<img src="smile/bratok.gif"/>',
'.cry.'=>'<img src="smile/cry.gif"/>',
'.do.'=>'<img src="smile/dovolen.gif"/>',
'.fu.'=>'<img src="smile/fuu.gif"/>',
'.gg.'=>'<img src="smile/gg.gif"/>',
'.gy.'=>'<img src="smile/gy.gif"/>',
'.ha.'=>'<img src="smile/ha.gif"/>',
'.haha.'=>'<img src="smile/haha.gif"/>',
'.help.'=>'<img src="smile/helpme.gif"/>',
'.hm.'=>'<img src="smile/hm.gif"/>',
'.hr.'=>'<img src="smile/hrap.gif"/>',
'.is.'=>'<img src="smile/isterika.gif"/>',
'.kr.'=>'<img src="smile/krasn.gif"/>',
'.lol.'=>'<img src="smile/lol.gif"/>',
'.pl.'=>'<img src="smile/plak.gif"/>',
'.pr.'=>'<img src="smile/preved.gif"/>',
'.rofl.'=>'<img src="smile/rofl.gif"/>',
'.sh.'=>'<img src="smile/shok.gif"/>',
'.sry.'=>'<img src="smile/sorry.gif"/>',
'.st.'=>'<img src="smile/stena.gif"/>',
'.vo.'=>'<img src="smile/vosadok.gif"/>',
'.ho.'=>'<img src="smile/yahoo.gif"/>',
'.zl.'=>'<img src="smile/zloj.gif"/>',
'.kur.'=>'<img src="smile/kur.gif"/>',
'.kq.'=>'<img src="smile/kurqiz.gif"/>',
'.yod.'=>'<img src="smile/yod.gif"/>',
'.e1.'=>'<img src="smile/e1.png" height="20" width="20"/>',
'.e2.'=>'<img src="smile/e2.png" height="20" width="20"/>',
'.e3.'=>'<img src="smile/e3.png" height="20" width="20"/>',
'.e4.'=>'<img src="smile/e4.png" height="20" width="20"/>',
'.e5.'=>'<img src="smile/e5.png" height="20" width="20"/>',
'.e6.'=>'<img src="smile/e6.png" height="20" width="20"/>',
'.e7.'=>'<img src="smile/e7.png" height="20" width="20"/>',
'.e8.'=>'<img src="smile/e8.png" height="20" width="20"/>',
'.e9.'=>'<img src="smile/e9.png" height="20" width="20"/>',
'.e10.'=>'<img src="smile/e10.png" height="20" width="20"/>',
'.e11.'=>'<img src="smile/e11.png" height="20" width="20"/>',
'.e12.'=>'<img src="smile/e12.png" height="20" width="20"/>',
'.e13.'=>'<img src="smile/e13.png" height="20" width="20"/>',
'.e14.'=>'<img src="smile/e14.png" height="20" width="20"/>',
'.e15.'=>'<img src="smile/e15.png" height="20" width="20"/>',
'.e16.'=>'<img src="smile/e16.png" height="20" width="20"/>',
));
return $text;
}

function k_date($str,$mesaj=false){
$SERVER_TIME = time();
$gun_ay_il = date('d.m.y', $str);
$date1=str_replace(date("d.m.y",$SERVER_TIME-86400), "1", $gun_ay_il);//dunen
$date2=str_replace(date("d.m.y",$SERVER_TIME), "2", $gun_ay_il);//bu gun
if($date1==1)
{
$str = "D&#252;nen";
}elseif($date2==2 and $mesaj!=false){
$str = $saat;
}elseif($date2==2){
$str = "Bu g&#252;n ";
}else{
if(date('Y', $str)!=date('Y', $SERVER_TIME)) $il_str = ".".date('Y', $str); else $il_str = "";
$aylar=array("Yanvar","Fevral","Mart","Aprel","May","&#304;yun","&#304;yul","Avqust","Sentyabr","Oktyabr","Noyabr","Dekabr");
$ay=date('n', $str)-1; 
$gun=date('d', $str); 
$str = $gun.".".$aylar[$ay].$il_str."";
}
return $str; 
}

function timeLeft($unix) {
 
    /**
     * Author: Gkinq
     * WP: (077) 537-64-93
     */
 
    $date = new DateTime();
    $date->setTimestamp($unix);
 
    $now = new DateTime();
 
    if($now > $date) {
        return false;
    }
 
    $interval = $date->diff($now);
 
    $result = '';
 
    if($interval->y) {
        $result .= $interval->format("%y il") . ' ';
    } 
 
    if($interval->m) {
        $result .= $interval->format("%m ay") . ' ';
    } 
 
    if($interval->d) {
        $result .= $interval->format("%d gun") . ' ';
    } 
 
    if($interval->h) {
        $result .= $interval->format("%h saat") . ' ';
    } 
 
    if($interval->i) {
        $result .= $interval->format("%i deq") . ' ';
    } 
 
    if($interval->s) {
        $result .= $interval->format("%s san");
    }
 
    return $result;
}
?>