<script type="text/javascript" src="/static/xiaozhi/js/c.js?20141211"></script>

<script type="text/javascript">
$(document).ready(function(){
$("#shadow").css("height", $(document).height()).hide();
$("#lightdown1").click(function(){
$("#shadow").toggle();
if ($("#shadow").is(":hidden"))
$(this).html("关灯").removeClass("lighton");
});
});
$(document).ready(function(){
$("#shadow").css("height", $(document).height()).hide();
$("#lightdown2").click(function(){
$("#shadow").toggle();
if ($("#shadow").is(":hidden"))
$(this).html("开灯").addClass("lighton");
});
});
function hidead(e) {
if($(e).text()=="关闭广告") {
$("div.ad960").hide().remove();
$("div.ad950").hide().remove();
$("div.ad300").hide().remove();
}
return false;
}
</script>

<div class="blank10"></div><div class="clear"></div><!-- tb1 -->
<div class="ad950">
<!-- 广告位：展示页头广告 -->
<script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
<script type="text/javascript">BAIDU_CLB_fillSlot("1041415");</script>
</div>

<div class="cnav">
<h3><a href="http://www.jieshuolol.com">解说lol</a> &gt; <a href="<?php echo $this->createUrl('list/index', array('pinyin' => $cate->pinyin)); ?>"><?php echo $cate->title; ?></a> &gt; <span> <?php echo $article->title; ?></span></h3>
</div>

<div class="box">
<div class="c_middle_title">
        <div class="c_middle_tab">
            <ul>

                        <li><a id="c_tab3" href="javascript:void(0);" onclick="iosplayer('youku','<?php echo $article->video; ?>','');" class="c_tab_on">通用播放器(兼容PC/Android/IOS)</a></li>
                        </ul>
        </div>
        <div class="c_middle_deng">
            <a id="lightdown1" href="javascript:light(2);" >关灯</a>
            <a id="lightdown2" href="javascript:light(1);" style="display:none;">开灯</a>
            <div id="shadow"></div>
        </div>
</div><div class="clear"></div>

<div class="c_middle">
        <div class="v_left">
<p id="showpagephoto"><script type="text/javascript">iosplayer('youku','<?php echo $article->video; ?>','');</script></p>
    </div>
    <div id="showad" class="v_right"><!-- tbc1 -->
        <div class="ad300">
            <!-- 广告位：展示页右一 -->
            <script type="text/javascript" >BAIDU_CLB_SLOT_ID = "1041452";</script>
            <script type="text/javascript" src="http://cbjs.baidu.com/js/o.js"></script>
        </div>
        <div class="blank300"></div><!-- bdc1 -->
        <div class="ad300">
            <!-- 广告位：展示页右二 -->
            <script type="text/javascript" >BAIDU_CLB_SLOT_ID = "1041454";</script>
            <script type="text/javascript" src="http://cbjs.baidu.com/js/o.js"></script>
        </div>
    </div><div class="clear"></div>



</div>
<div class="c_middle_tab">
    <div class="v_tab">
        <ul id="c_tab_3" style="display:block">
            <li>上一篇</li><a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $BeforeArticle[0]->id, 'pinyin' => $cate->pinyin)); ?>"title='<?php echo $BeforeArticle[0]->title; ?>'>
            <li><?php echo Helper::truncate_utf8_string($BeforeArticle[0]->title, 17, '...'); ?></li>

            </a>
            <li>下一篇</li><a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $NextArticle[0]->id, 'pinyin' => $cate->pinyin)); ?>" title='<?php echo $NextArticle[0]->title; ?>' ><li><?php echo Helper::truncate_utf8_string($NextArticle[0]->title, 17, '...'); ?></li></a>
        </ul>
    </div>
    <div class="c_tab">
        <ul>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        </ul>
    </div>
</div>

</div>

</div>

<div class="blank10"></div><div class="clear"></div><!-- bd1 -->
<div class="ad960">
    <!-- 广告位：展示页中部 -->
    <script type="text/javascript" >BAIDU_CLB_SLOT_ID = "1041456";</script>
    <script type="text/javascript" src="http://cbjs.baidu.com/js/o.js"></script>
</div>
<div class="blank10"></div><div class="clear"></div>

<div class="box">
    <div class="comment_left">
<!-- Duoshuo Comment BEGIN -->
    <div class="ds-thread" data-thread-key="133495" data-title="《杨乃武与小白菜》郭德纲 于谦_德云社2014" data-image="http://img.6pingm.com/2014/10/05/35afce1fdac03ccafbfb485a9dd474d0.jpg" data-url="http://6pingm.com/deyunshe/133495.html"></div>

<!-- Duoshuo Comment END -->
    </div>
<div class="comment_left">
<!-- ChangYan  BEGIN -->

<div id="SOHUCS" sid="<?php echo $article->id ?>" style="width: 100%; height: auto;"></div>

<script>
  (function(){
    var appid = 'cyrCC2m64',
    conf = 'prod_57e675cfd6bb8d6ea1061cdda29d1bf5';
    var doc = document,
    s = doc.createElement('script'),
    h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;
    s.type = 'text/javascript';
    s.charset = 'utf-8';
    s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;
    h.insertBefore(s,h.firstChild);
    window.SCS_NO_IFRAME = true;
  })()
</script>
<script type="text/javascript" charset="utf-8" src="http://changyan.itc.cn/js/??lib/jquery.js,changyan.labs.js?appid=cyrgKYddV"></script>
<!-- changYan END -->
    </div>
    <div class="comment_r">
    <div class="comment_right">
    <div class="comment_right_title"><h2><?php echo $cate->title; ?>最新lol视频</h2></div>
    <ul>
        <?php foreach ($tuijianarticle as $key => $article) {?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->ArticleOne->id, 'pinyin' => $article->CateOne->pinyin)); ?>" target="_blank">
            <img src="<?php echo Yii::app()->params['photoUrl']; ?><?php echo $article->ArticleOne->image_url; ?>" alt="<?php echo $article->ArticleOne->title; ?>" />
            <span class="v_ishd">高清</span>
            <span class="v_time"><?php echo $article->ArticleOne->video_time; ?></span>
            <span class="v_bg"></span>
            </a>
            <span><a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->ArticleOne->id, 'pinyin' => $article->CateOne->pinyin)); ?>" title="<?php echo $article->ArticleOne->title; ?>" target="_blank"><?php echo $article->ArticleOne->title; ?></a></span><p>分类: <a href="<?php echo Yii::app()->createUrl('list/index', array('pinyin' => $article->CateOne->pinyin)); ?>" target="_blank"><?php echo $article->CateOne->title; ?></a></p>
            <span>时间：<?php echo $article->ArticleOne->published_time; ?></span>
        </li>
        <?php }?>
    </ul><div class="clear"></div>
    </div>
    <div class="blank300"></div><!-- bdc2 -->
    <div class="ad300">广告位</div>
    </div><div class="clear"></div>
</div>
