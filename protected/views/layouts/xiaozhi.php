<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="X-UA-Compatible" content="IE=8">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $this->title; ?></title>
<meta name="keywords" content="<?php echo $this->keywords; ?>">
<meta name="description" content="<?php echo $this->description; ?>">
<link type="text/css" rel="stylesheet" href="http://cj.xinniangjie.com/static/xiaozhi/css/style.css">
<script type="text/javascript" src="http://cj.xinniangjie.com/static/xiaozhi/js/settab.js"></script>
<script type="text/javascript" src="http://cj.xinniangjie.com/static/xiaozhi/js/jquery.js"></script>
<script type="text/javascript">
function hidead(e) {
if($(e).text()=="关闭广告") {
$("div.ad960").hide().remove();
$("div.ad950").hide().remove();
}
return false;
}
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?da7a5668364f940a695729b1e47abb36";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>

<div class="top_bg">
    <div class="top">
        <div class="top_left">
            <ul>
            <li> </li>
            </ul>
        </div>
        <div class="top_right">
            <ul>



            <!-- <li><a href="http://so.6pingm.com/">搜索</a></li> -->

            <li><a target="_self" href="javascript:void(0)" onclick="window.external.addFavorite(location.href,document.title)">收藏</a></li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
function closead()
{
    var ad = document.getElementsByName("ad_6pingm");
    for(i=0;i<ad.length;i++){
    ad[i].innerHTML=''
}
}
</script>

<div class="header">
    <div class="logo"><a href="http://cj.xinniangjie.com" title="解说lol"></a></div>
<div class="header_b"><a href="javascript:void();" onclick="return hidead(this)" target="_self">关闭广告</a></div>

    <div class="search">



    </div>
</div>
<div class="nav_bg">
    <div class="nav">
        <ul>

        <li <?php if ($this->id == 'site') {?>class="navon"<?php }
?>><a href="http://cj.xinniangjie.com">首页</a></li>

        <li <?php if ($this->_catePinyin == 'xiaozhi') {?>class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaozhi')); ?>" target="_blank">小智</a></li>
        <li <?php if ($this->_catePinyin == 'jy') {?> class="navon" <?php }
?> ><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'jy')); ?>" target="_blank">JY</a></li>
        <li <?php if ($this->_catePinyin == 'xiaomo') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaomo')); ?>" target="_blank">小漠</a></li>
        <li <?php if ($this->_catePinyin == 'miss') {?>class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'miss')); ?>" target="_blank">MISS</a></li>
        <li <?php if ($this->_catePinyin == 'xiaocang') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaocang')); ?>" target="_blank">小苍</a></li>
        <li <?php if ($this->_catePinyin == 'dbdac') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'dbdac')); ?>" target="_blank">东北大鹌鹑 </a></li>
        <li <?php if ($this->_catePinyin == 'white55kai') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'white55kai')); ?>" target="_blank">white55开</a></li>

        <li <?php if ($this->_catePinyin == 'cx') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'cx')); ?>" target="_blank">CX漫玩世界</a></li>
       <li <?php if ($this->_catePinyin == 'we') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'we')); ?>" target="_blank">WE战队</a></li>
       <li <?php if ($this->_catePinyin == 'zbsp') {?> class="navon"<?php }
?>><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'zbsp')); ?>" target="_blank">直播视频</a></li>
        </ul>

    </div>
</div>
<div class="menu_bg">
    <div class="menu">
        <ul>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaozhi')); ?>" title="小智" target="_blank">小智</a></li>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaomo')); ?>" title="小漠" target="_blank">小漠</a></li>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'we')); ?>" title="WE战队" target="_blank">WE战队</a></li>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'zbsp')); ?>" title="直播视频" target="_blank">直播视频</a></li>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'machao')); ?>" title="上海马超 " target="_blank">上海马超 </a></li>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'quantou')); ?>" title="拳头" target="_blank">拳头</a></li>
        <li><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'yd')); ?>" title="YD" target="_blank">YD</a></li>
        </ul>
    </div>
</div>

<?php echo $content; ?>



<div class="blank10">
</div>

<div class="clear">

</div>
<div class="ad960">
<script type="text/javascript">
    /*创建于 2017/2/27*/
    var cpro_id = "u2905421";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>
</div>

<div class="footer">
    <div class="blank10"></div><div class="clear"></div>
    <div class="blank10"></div><div class="clear"></div>
    <div class="box">
    <p>Copyright © 2010-2015 jieshuolol.com All Rights Reserved <a href="http://www.miibeian.gov.cn" target="_blank">备案号 京ICP备13048705号-3</a></p>
    </div>
    <div class="blank10"></div><div class="clear"></div>
    <div class="blank10"></div><div class="clear"></div>
</div>




</body>
<script type="text/javascript">
    /*120*270 创建于 2015-04-07*/
var cpro_id = "u2031438";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>

</html>