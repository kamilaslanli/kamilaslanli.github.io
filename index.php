<?php
session_start();
@require_once("db.php");
@require_once("./file/func.php");
@require_once("head.php");

$ref=rand(1111,9999);

date_default_timezone_set("Asia/Dubai");
$vaxt = date('d/m/y - H:i');
$tarix = time();
if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: login.php');

}else{

$user=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".intval($_GET['id'])."' and `pass`='".htmlspecialchars($_GET['ps'])."'"));

if($user['id']==0){
print('<div class="menu3">* <font color="red">Sehv</font></div><div class="menu3">Bele bir istifadeci yoxdur ve ya nicki silinib!<br/>---<br/><a href="/">Geri</a></div>');
} else {

echo '<title>ID:'.$_GET['id'].' / '.$user['user'].'</title>';

/*
$SQL = mysql_query("SELECT * FROM `mesaj` ORDER BY `id` DESC LIMIT 1");

while($dt = mysql_fetch_row($SQL)){

//echo $dt['1'];
//echo date('d.m.Y');
echo date('d.m.Y', ''.$dt[4].'');

}
*/
mysql_query("update `users` set `on`='".(time()+300)."' where `id`='".intval($_GET['id'])."'");
		$all=mysql_result(mysql_query("select count(*) from `mesaj`"),0);
		print('<div class="line-menu">Login: <b>'.$user['user'].' / '.$user['id'].'</b><div style="float:right;"><a href="'.$url.'/file/on.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'"><b>ON: '.mysql_result(mysql_query("select count(*) from `users` where `on`>".time().""),0).'</b></a></div></div>
<div class="menu-border"><div class="menu3">');


$allSMS=mysql_result(mysql_query("select count(*) from `o_sms`"),0);
if($allSMS==0){
		print('<div class="st_2" style="background:white;border-radius:20px ;"><center><a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'">Online SMS:</a> Online SMS yazilmayib</center></div>');
	}else{
$mesaj=mysql_query("select * from `o_sms` order by `id` desc limit 0,1");
		
		while($kamil=mysql_fetch_assoc($mesaj)){
			$i++;
                        $k_all = mysql_num_rows(mysql_query("SELECT * FROM `comm` WHERE `mesaj_id`='".$kamil['id']."'"));
                         $k_allb = mysql_num_rows(mysql_query("SELECT * FROM `smslike` WHERE `smsid`='".$kamil['id']."'"));
			$userinf=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$kamil['uid']."'"));
			print('<div class="st_2"><center><a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'">Online SMS:</a> <i>'.smi(bb_code(nl2br($kamil['text']))).'</i>(<a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=like&b='.$kamil['id'].'&ref='.$ref.'">Beyen</a> <img src="img/beyen.png" alt="beyen"/> <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=kim&b='.$kamil['id'].'&ref='.$ref.'">'.$k_allb.'</a> &#8226; <a href="sms.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&k=fikir&fid='.$kamil['id'].'&ref='.$ref.'">Fikir-'.$k_all.'</a> <img src="img/fikir.png" alt="fikir"/>) <b><i>Müəllif:</i></b> <b><a href="info.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nk='.$kamil['uid'].'">'.$kamil['nik'].'</a></b></center></div>');
		}
}







 if(isset($_POST['submit'])){
if(empty($_POST['text'])){

             echo '<hr/><font color="red">Mesajınızı daxil edin.</font><hr style="border-top:1px dotted #f00;"/>';
} else {

if(!empty($_POST['text']) and $_POST['token']==$_SESSION['token']){

$text = htmlentities($_POST[text], ENT_QUOTES, "UTF-8");

	if(mysql_result(mysql_query("select count(*) from `mesaj` where `uid`='".intval($_GET['id'])."' and `text`='".htmlspecialchars(trim($_POST['text']))."'"),0)==0){
		mysql_query("insert into `mesaj` set `uid`='".$user['id']."',`nik`='".$user['user']."',`text`='".$text."',`vaxt`='".$tarix."'");
		header("location: ".$_SERVER['HTTP_REFERER']."");
	}else {
		print('* <font color="red">Oxşar mesaj yazılıb!</font><hr style="border-top:1px dotted #f00;"/>');
	}
}


}
}

	$_SESSION['token']=md5(rand(11111111,999999999));



	print('<hr/><form name="form" action="" method="post">Mesajınız:<br/>


<script language="JavaScript" type="text/javascript">
            function tag(text1, text2) {
              if ((document.selection)) {
                document.form.text.focus();
                document.form.document.selection.createRange().text = text1+document.form.document.selection.createRange().text+text2;
              } else if(document.forms["form"].elements["text"].selectionStart!=undefined) {
                var element = document.forms["form"].elements["text"];
                var str = element.value;
                var start = element.selectionStart;
                var length = element.selectionEnd - element.selectionStart;
                element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
              } else {
                document.form.text.value += text1+text2;
              }
            }
            function show_hide(elem) {
              obj = document.getElementById(elem);
              if( obj.style.display == "none" ) {
                obj.style.display = "block";
              } else {
                obj.style.display = "none";
              }
            }
            </script>
<script>
function temizle(){
document.getElementById(\'smi\').value = \'\';
document.getElementById(\'smi\').rows = 2;
}
</script>

<script>
function sm(textId, code) {
var textField = document.getElementById(textId);
textField.value = textField.value + " " + code;
}
</script>

<a href="javascript:tag(\'[b]\', \'[/b]\')"><img src="'.$url.'/img/bb/bold.gif" alt="b" title="qalin" border="0"/></a>
<a href="javascript:tag(\'[i]\', \'[/i]\')"><img src="'.$url.'/img/bb/italics.gif" alt="i" title="eyri" border="0"/></a>
<a href="javascript:tag(\'[u]\', \'[/u]\')"><img src="'.$url.'/img/bb/underline.gif" alt="u" title="alti xetli" border="0"/></a>
<a href="javascript:tag(\'[s]\', \'[/s]\')"><img src="'.$url.'/img/bb/strike.gif" alt="s" title="ustu xetli" border="0"/></a>
<a href="javascript:tag(\'[color=red]\', \'[/color]\')"><img src="'.$url.'/img/bb/color.gif" alt="color" title="reng" border="0"/></a>
<a href="javascript:show_hide(\'bg\');"><img style="border: 0;" src="'.$url.'/img/bb/color_bg.gif" title="arxa fon" alt="bg color" /></a>
<a href="javascript:tag(\'[url=http://link]adi\', \'[/url]\')"><img src="'.$url.'/img/bb/link.gif" alt="url" title="url" border="0"/></a>
<a href="javascript:tag(\'[foto=http://foto]\', \'\')"><img src="'.$url.'/img/bb/img.gif" alt="img" title="foto" border="0"/></a>
<a href="javascript:void(0)" onclick="ds=document.getElementById(\'smile\'); if(ds.style.display==\'none\'){ds.style.display=\'\'; }else{ds.style.display=\'none\';}"><img src="'.$url.'/img/bb/smileys.gif" alt="smile" title="smile"></a>
<a href="javascript:temizle()"><img src="'.$url.'/img/bb/temizle.png" alt="temizle" title="t&#601;mizl&#601;"></a><br/>

<div id="bg" style="display:none">
<a href="javascript:tag(\'[bg=#0000FF]\', \'[/bg]\')"><font size="7" color="#0000FF">&bull;</font></a>
<a href="javascript:tag(\'[bg=#FF0000]\', \'[/bg]\')"><font size="7" color="#FF0000">&bull;</font></a>
<a href="javascript:tag(\'[bg=#00FF00]\', \'[/bg]\')"><font size="7" color="##00FF00">&bull;</font></a>
</div>


<div id="smile" style="display:none;max-width:230px;">
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.ha.&quot;);">
<img width="20" height="20" alt="" src="smile/ha.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.aa.&quot;);">
<img width="20" height="20" alt="" src="smile/aaa.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.ah.&quot;);">
<img width="20" height="20" alt="" src="smile/ah.gif"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.bla.&quot;);">
<img width="20" height="20" alt="" src="smile/blabla.gif"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.bro.&quot;);">
<img width="20" height="20" alt="" src="smile/bratok.gif"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.cry.&quot;);">
<img width="20" height="20" alt="" src="smile/cry.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.do.&quot;);">
<img width="20" height="20" alt="" src="smile/dovolen.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.fu.&quot;);">
<img width="20" height="20" alt="" src="smile/fuu.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.gg.&quot;);">
<img width="20" height="20" alt="" src="smile/gg.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.gy.&quot;);">
<img width="20" height="20" alt="" src="smile/gy.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.haha.&quot;);">
<img width="20" height="20" alt="" src="smile/haha.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.help.&quot;);">
<img width="20" height="20" alt="" src="smile/helpme.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.hm.&quot;);">
<img width="20" height="20" alt="" src="smile/hm.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.hr.&quot;);">
<img width="20" height="20" alt="" src="smile/hrap.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.is.&quot;);">
<img width="20" height="20" alt="" src="smile/isterika.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.kr.&quot;);">
<img width="20" height="20" alt="" src="smile/krasn.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.lol.&quot;);">
<img width="20" height="20" alt="" src="smile/lol.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.pl.&quot;);">
<img width="20" height="20" alt="" src="smile/plak.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.pr.&quot;);">
<img width="20" height="20" alt="" src="smile/preved.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.rofl.&quot;);">
<img width="20" height="20" alt="" src="smile/rofl.gif"/> </a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.sh.&quot;);">
<img width="20" height="20" alt="" src="smile/shok.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.sry.&quot;);">
<img width="20" height="20" alt="" src="smile/sorry.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.st.&quot;);">
<img width="20" height="20" alt="" src="smile/stena.gif"/></a>  
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.vo.&quot;);">
<img width="20" height="20" alt="" src="smile/vosadok.gif"/> </a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.ho.&quot;);">
<img width="20" height="20" alt="" src="smile/yahoo.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.zl.&quot;);">
<img width="20" height="20" alt="" src="smile/zloj.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.kur.&quot;);">
<img width="20" height="20" alt="" src="smile/kur.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.kq.&quot;);">
<img width="20" height="20" alt="" src="smile/kurqiz.gif"/></a> 
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.yod.&quot;);">
<img width="20" height="20" alt="" src="smile/yod.gif"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e1.&quot;);">
<img width="20" height="20" alt="" src="smile/e1.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e2.&quot;);">
<img width="20" height="20" alt="" src="smile/e2.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e3.&quot;);">
<img width="20" height="20" alt="" src="smile/e3.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e4.&quot;);">
<img width="20" height="20" alt="" src="smile/e4.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e5.&quot;);">
<img width="20" height="20" alt="" src="smile/e5.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e6.&quot;);">
<img width="20" height="20" alt="" src="smile/e6.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e7.&quot;);">
<img width="20" height="20" alt="" src="smile/e7.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e8.&quot;);">
<img width="20" height="20" alt="" src="smile/e8.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e9.&quot;);">
<img width="20" height="20" alt="" src="smile/e9.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e10.&quot;);">
<img width="20" height="20" alt="" src="smile/e10.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e11.&quot;);">
<img width="20" height="20" alt="" src="smile/e11.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e12.&quot;);">
<img width="20" height="20" alt="" src="smile/e12.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e13.&quot;);">
<img width="20" height="20" alt="" src="smile/e13.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e14.&quot;);">
<img width="20" height="20" alt="" src="smile/e14.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e15.&quot;);">
<img width="20" height="20" alt="" src="smile/e15.png"/></a>
<a href="#" onclick="sm(&quot;smi&quot;, &quot;.e16.&quot;);">
<img width="20" height="20" alt="" src="smile/e16.png"/>
</a></div>


 <textarea name="text" id="smi"></textarea><br/>
	<input type="hidden" name="token" value="'.$_SESSION['token'].'"/>
	<input type="submit" name="submit" value="Göndər" style="width:auto;"/> <a href="'.$url.'/voice.php?id='.intval($_GET['id']).'&amp;ps='.htmlspecialchars($_GET['ps']).'"><img src="img/rec_mic.png" title="mic"/></a>
	</form><hr/>');


	if($_GET['go']=='temizle' and $user['id']==1){
		if($_GET['ok']==1){
			mysql_query("truncate table `mesaj`");
			header("location: index.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
		}
	print('&raquo; Otagi temizlemek istediyinize eminsiniz ?<br/>
	[<a href="?id='.$_GET['id'].'&ps='.$_GET['ps'].'&go=temizle&ok=1&ref='.$ref.'">Beli</a>] | [<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Xeyr</a>]
	<br/>----<br/>');
}elseif($_GET['mdel']!=0 and $user['id']==1){
	mysql_query("delete from `mesaj` where `id`='".$_GET['mdel']."'");
	header("location: index.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
}elseif($_GET['ndel']!=0 and $user['id']==1){
	if($_GET['ok']==1){
	mysql_query("delete from `users` where `id`='".$_GET['ndel']."'");
	mysql_query("delete from `mesaj` where `uid`='".$_GET['ndel']."'");
	header("location: index.php?id=".intval($_GET['id'])."&ps=".htmlspecialchars($_GET['ps'])."&ref=$ref");
	}
	print('&raquo; <u><b>'.$_GET['nick'].'</b></u> -  nikini silmek istediyinize eminsiniz ?<br/>
	[<a href="?id='.$_GET['id'].'&ps='.$_GET['ps'].'&ndel='.$_GET['ndel'].'&ok=1&ref='.$ref.'">Beli</a>] | [<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">Xeyr</a>]
	<br/>----<br/>');
}

if($_GET['edit']!=0 and $user['id']==1){
echo '<form name="form" action="" method="post"><textarea name="edit"></textarea><br/>
	<input type="submit" name="submit" value="DEYIS" style="width:auto;"/>
	</form>';
}


	print(''.($user['id']==1 ? '<a href="?id='.$_GET['id'].'&ps='.$_GET['ps'].'&go=temizle&ref='.$ref.'"><img src="img/del.png" title="temizle"/></a> | ' : '').'
	<img src="img/ic_sms.png" title="sms"/> ('.$all.')</b> | 
       <a href="gallery.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'"><img src="img/ic_img.png" title="img"/></a> | 
       <a href="gallery.php?act=video&id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'"><img src="img/ic_vid.png" title="img"/></a> | 
       <a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'"><img src="img/ic_ref.png" title="ref"/></a>
	</div><div class="menu3"><div class="wbg">
');
	if($all==0){
		print('Otaq təmizlənmişdir, 1 ci yaz 1 ci ol.');
	}else{
		$page=(int)$_GET['page'];
		if(empty($page)) $page=1;
		$limit=10;
		$sehife_s=ceil($all/$limit);
		if($page>$sehife_s)$page=1;
		$goster=$page*$limit-$limit;
		$mesaj=mysql_query("select * from `mesaj` order by `vaxt` desc limit $goster,$limit");
		function div($a){
			if($a==1){
				return 'you';
			}elseif($a==2){
				return 'my';
			}elseif($a==3){
				return 'you';
			}elseif($a==4){
				return 'my';
			}elseif($a==5){
				return 'you';
			}elseif($a==6){
				return 'my';
			}elseif($a==7){
				return 'you';
			}elseif($a==8){
				return 'my';
			}elseif($a==9){
				return 'you';
			}elseif($a==10){
                                return 'my';
                        }elseif($a==11){
				return 'you';
			}
		}


                $lastTime = '';
		while($m=mysql_fetch_assoc($mesaj)){
			$i++;
                        $_SESSION['nik'] = $m['uid'];
			$userinf=mysql_fetch_assoc(mysql_query("select * from `users` where `id`='".$m['uid']."'"));
                        
if(k_date($m['vaxt']) != $lastTime)
  {
   $lastTime = k_date($m['vaxt'],'');
   echo ('<div class="dateBody"><span style="white-space:nowrap; padding:2px 10px;margin-bottom:5px;display: inline-table;">'.$lastTime.'</span></div>');
}
			print('<div class="window"><div class="chats">'.($user['user']==$m['nik'] ? ' <span class="u1 chat">':'<span class="u2 chat">').'
			<!--<img src="img/'.($userinf['sex']==1 ? 'men' : 'girl').'.png" alt="icon"/>-->');
			
                       
if($userinf['img']==NULL){
echo '<img style="border-radius: 100%; border: 1px dashed red; width: 32px; height: 32px;" src="img/default_foto.jpeg"> ';
}else{
echo '<img style="border-radius: 100%; border: 1px dashed red; width: 32px; height: 32px;" src="'.$userinf['img'].'"> ';
}


			print('<b><a href="info.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&nk='.$m['uid'].'">'.$m['nik'].'</a></b> '.($userinf['on']>time() ? '<img src="img/on.gif" alt="on"/>' : '<img src="img/off.gif" alt="off"/>').'
			<a href="javascript:tag(\'[b]'.$m['nik'].'[/b]\', \', \')"><img src="'.$url.'/img/reply.png" alt="b" title="Cavab" border="0"/></a><br/><small><img src="img/time.png" alt="time"/>'.date('H:i',$m[vaxt]).'</small><br>
			'.smi(bb_code(nl2br($m['text']))).'<br/><div style="text-align:right;"><img src="img/message_read.png" height="20" width="20" alt="read"/>'.($user['id']==1 ? ' <a href="admin/edit.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&edit='.$m['id'].'"><img src="img/edit.png" alt="sil"/></a> - <a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&mdel='.$m['id'].'"><img src="img/del.png" alt="sil"/></a>':'').'</div></span></div></div>');
		}
	}

	
	if($all>$limit){
		print('</div></div><div class="menu3"><center>');
		if($page>1){
			print ('<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page-1).'&ref='.$ref.'">&laquo; Evvelki</a>');
                       
		}
		if($page>1){
			print(' | ');
                       
		}
		if($page!=$sehife_s){
			print ('<a href="index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&page='.($page+1).'&ref='.$ref.'">Sonraki &raquo;</a>');
                       
		}
		
	}
               print '</center></div></div>';


}
@require_once ("foot.php");
}



?>