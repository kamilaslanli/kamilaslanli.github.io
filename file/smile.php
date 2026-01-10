<?php
require_once '../db.php';
require_once 'func.php';
require_once '../head.php';

if(empty($_GET['id']) or empty($_GET['ps'])){


header ('location: '.$url.'/login.php');

}else{

echo '<title>Smaylikler</title>';


echo '<div class="line-menu">Smaylikler</div>
<div class="menu-border"><div class="menu3">';




echo '<img src="../smile/aaa.gif"/> - .aa. <br/>
<img src="../smile/ah.gif"/> - .ah. <br/>
<img src="../smile/blabla.gif"/> - .bla. <br/> 
<img src="../smile/bratok.gif"/> - .bro. <br/>
<img src="../smile/cry.gif"/> - .cry. <br/>
<img src="../smile/dovolen.gif"/> - .do. <br/>
<img src="../smile/fuu.gif"/> - .fu. <br/> 
<img src="../smile/gg.gif"/> - .gg. <br/>
<img src="../smile/gy.gif"/> - .gy. <br/>
<img src="../smile/ha.gif"/> - .ha. <br/>
<img src="../smile/haha.gif"/> - .haha. <br/>
<img src="../smile/helpme.gif"/> - .help. <br/>
<img src="../smile/hm.gif"/> - .hm. <br/>
<img src="../smile/hrap.gif"/> - .hr. <br/>
<img src="../smile/isterika.gif"/> - .is. <br/>
<img src="../smile/krasn.gif"/> - .kr. <br/>
<img src="../smile/lol.gif"/> - .lol. <br/>
<img src="../smile/plak.gif"/> - .pl. <br/>
<img src="../smile/preved.gif"/> - .pr. <br/>
<img src="../smile/rofl.gif"/> - .rofl. <br/>
<img src="../smile/shok.gif"/> - .sh. <br/>
<img src="../smile/sorry.gif"/> - .sry. <br/>
<img src="../smile/stena.gif"/> - .st. <br/>
<img src="../smile/vosadok.gif"/> - .vo. <br/>
<img src="../smile/yahoo.gif"/> - .ho. <br/>
<img src="../smile/zloj.gif"/> - .zl. </div>';

echo '<div class="menu3"><a href="'.$url.'/index.php?id='.intval($_GET['id']).'&ps='.htmlspecialchars($_GET['ps']).'&ref='.$ref.'">&laquo; Geri</a></div></div>';
}
require_once ('../foot.php');
?>