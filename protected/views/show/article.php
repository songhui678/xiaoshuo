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
<script type="text/javascript" >BAIDU_CLB_SLOT_ID = "1041449";</script>
<script type="text/javascript" src="http://cbjs.baidu.com/js/o.js"></script>

</div>

<div class="cnav">
<h3><a href="http://www.jieshuolol.com">解说lol</a> &gt; <a href="<?php echo $this->createUrl('list/index', array('pinyin' => $cate->pinyin));?>"><?php echo $cate->title;?></a> &gt; <span> <?php echo $article->title;?></span></h3>
</div>

<div class="box">


</div>
</div>
</div>
<div class="blank10"></div><div class="clear"></div><!-- bd1 -->
<div class="box">
    <div class="comment_left">
        <?php echo $article->content;?>
    </div>
    <div class="comment_r">
    <div class="comment_right">
    <div class="comment_right_title"><h2><?php echo $cate->title;?>最新lol视频</h2></div>
    <ul>
        <?php foreach ($tuijianarticle as $key => $article) {?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->ArticleOne->id, 'pinyin' => $article->CateOne->pinyin));?>" target="_blank">
            <img src="<?php echo Yii::app()->params['photoUrl'];?><?php echo $article->ArticleOne->image_url;?>" alt="<?php echo $article->ArticleOne->title;?>" />
            <span class="v_ishd">高清</span>
            <span class="v_time"><?php echo $article->ArticleOne->video_time;?></span>
            <span class="v_bg"></span>
            </a>
            <span><a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->ArticleOne->id, 'pinyin' => $article->CateOne->pinyin));?>" title="<?php echo $article->ArticleOne->title;?>" target="_blank"><?php echo $article->ArticleOne->title;?></a></span><p>分类: <a href="<?php echo Yii::app()->createUrl('list/index', array('pinyin' => $article->CateOne->pinyin));?>" target="_blank"><?php echo $article->CateOne->title;?></a></p>
            <span>时间：<?php echo $article->ArticleOne->add_time;?></span>
        </li>
        <?php }?>
    </ul><div class="clear"></div>
    </div>
    <div class="blank300"></div><!-- bdc2 -->
    <div class="ad300">广告位</div>
    </div><div class="clear"></div>
</div>
