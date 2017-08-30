<div class="blank10"></div><div class="clear"></div><!-- tb1 -->
<div class="ad950">
<script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
<script type="text/javascript">BAIDU_CLB_fillSlot("1041415");</script>
</div>

<div class="blank10"></div><div class="clear"></div>

<div class="box">
    <div class="index_middle">
    <div class="index_middle_title">
        <h1><a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaozhi')); ?>">小智解说lol视频</a></h1>
    <h4>
        <a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaozhi')); ?>" target="_blank">小智最新视频</a>

    </h4>
        <h3>
            <ul>
            <a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaozhi')); ?>"><li id="gdg1" onmouseover="setTab('gdg',1,2);" class="h3on">小智最新解说lol视频</li></a>
    <a href="<?php echo $this->createUrl('list/index', array('pinyin' => 'xiaozhi')); ?>" target="_blank"><li id="gdg2" onmouseover="setTab('gdg',2,2);">解说lol视频</li></a>
            </ul>
        </h3>
    </div>

    <div class="index_middle_c con2" id="con_gdg_2">
    <ul>
     <?php foreach ($articleList as $key => $article) {?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->article_id, 'pinyin' => $article->CateOne->pinyin)); ?>" target="_blank">
                <img src="<?php echo Yii::app()->params['photoUrl']; ?><?php echo $article->ArticleOne->image_url; ?>" alt="<?php echo $article->ArticleOne->title; ?>" title="<?php echo $article->ArticleOne->title; ?>">
                <span class="v_ishd">超清</span>
                <span class="v_time"><?php echo $article->ArticleOne->video_time; ?>分钟</span>
                <span class="v_bg"></span>
            </a>

                <a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->ArticleOne->id)); ?>" target="_blank"><?php echo Helper::truncate_utf8_string($article->ArticleOne->title, 17, '...'); ?></a>

            <p>分类：<a href="<?php echo Yii::app()->createUrl('list/index', array('pinyin' => $article->CateOne->pinyin)); ?>" target="_blank"><?php echo $article->CateOne->title; ?></a></p>
            <span>时间：<?php echo $article->ArticleOne->published_time; ?></span>
        </li>
    <?php }
?>
    </ul><div class="clear"></div>
    </div>


    <div class="index_middle_c con1" id="con_gdg_1">
    <ul>
     <?php foreach ($articleList as $key => $article) {?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->article_id, 'pinyin' => $article->CateOne->pinyin)); ?>" target="_blank">
                <img src="<?php echo Yii::app()->params['photoUrl']; ?><?php echo $article->ArticleOne->image_url; ?>" alt="<?php echo $article->ArticleOne->title; ?>" title="<?php echo $article->ArticleOne->title; ?>">
                <span class="v_ishd">超清</span>
                <span class="v_time"><?php echo $article->ArticleOne->video_time; ?>分钟</span>
                <span class="v_bg"></span>
            </a>

                <a href="<?php echo Yii::app()->createUrl('show/index', array('id' => $article->article_id, 'pinyin' => $article->CateOne->pinyin)); ?>" target="_blank"><?php echo Helper::truncate_utf8_string($article->ArticleOne->title, 17, '...'); ?></a>

            <p>分类：<a href="<?php echo Yii::app()->createUrl('list/index', array('pinyin' => $article->CateOne->pinyin)); ?>" target="_blank"><?php echo $article->CateOne->title; ?></a></p>
            <span>时间：<?php echo $article->ArticleOne->published_time; ?></span>
        </li>
    <?php }
?>

    </ul><div class="clear"></div>
    </div>

    </div>
</div>

<div class="blank10"></div><div class="clear"></div><!-- bd2 -->

<div class="box">
    <div class="index_middle">
    <div class="index_middle_title">
        <h1><a>友情链接</a></h1>
        <h4>不定期删除降权网站，恕不通知。申请链接：songhui-6@qq.com 意见建议：songhui-6@qq.com 网站合作：songhui-6@qq.com</h4>
    </div>
    <div class="index_middle_c">
    <ul>


    </ul><div class="clear"></div>
    </div>
    </div>
</div>