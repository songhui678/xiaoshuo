<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7">
<title><?php echo $this->pageKeyword['title']; ?></title>
<meta name="description" content="<?php echo $this->pageKeyword['description']; ?>"/>
<meta name="keywords" content="<?php echo $this->pageKeyword['keywords']; ?>" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/topbar.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/directory.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/mini.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="/js/xiaoshuo.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?793984a5368dc8faeee2829c32d6a07c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body style="background:#FFFFFF">
<div class="center">
			<h1><a href="#">hao123小说</a></h1>
			<div class="search clearfix"><form onsubmit="return qrsearch();" method="get" action="/search/" name="search" id="search">
                <input type="text" class="searchinput acInput" x-webkit-grammar="builtin:translate" x-webkit-speech="" autofocus="true" onsubmit="return qrsearch();" onblur="if(this.value=='') this.value=this.title;" onfocus="if(this.value==this.title) this.value='';" title="请输入小说名..." autocomplete="off" value="请输入小说名..." name="kw" id="kw">
				<input type="submit" value="搜索" class="searchsubmit">            </form>
				<p class="remens">
				热门搜索： 
				</p>
			</div>		
			<div class="other">
				<a id="fav" class="sc" href="#">收藏本站</a>
				<a class="fk boxy" href="#feedback">意见反馈</a>
			</div>
		</div>
<?php echo $content; ?>

<div class="footer" monkey="cool" style="border:0;" alog-alias="footer">
   <div id="ft">
			<!--footer--><p class="ft_link"><a href="#" target="_blank">关于本站</a><b>本站所收录作品、社区话题、书库评论及本站所做之广告均属网友个人行为，不代表本站立场,小说归作者所有人，如有侵犯到您的权利，请与我们联系<a class="beian" target="_blank" href="http://www.miibeian.gov.cn/">京ICP备13048705号1</a></p><div style="display:none;">
</div>
		</div>
</div>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F793984a5368dc8faeee2829c32d6a07c' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>