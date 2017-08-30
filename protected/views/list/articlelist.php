<link type="text/css" rel="stylesheet" href="http://www.jieshuolol.com/static/xiaozhi/css/base.css">
<div class="blank10"></div><div class="clear"></div><!-- tb1 -->
<div class="ad950">
<!-- 广告位：列表页头部 -->
<a href="http://s.click.taobao.com/t?e=m%3D2%26s%3DzVqxGCKl3swcQipKwQzePCperVdZeJviEViQ0P1Vf2kguMN8XjClAvQDJn17vkLGGAcW%2BgUaNBLe%2F1sFzZMQ9F0XuoxVDX8JvasjTP4fHY8KSh3Dx9OcDudn1BbglxZYxUhy8exlzcq9AmARIwX9K16Ni416s6YRPV1H2z0iQv9eY%2By0blbhscYl7w3%2FA2kb"><img src="http://img.jieshuolol.com/ad/2015-03-20/950·90.gif"/></a>
</div>

<div class="blank10"></div><div class="clear"></div>
<div class="indexbox">

<div class="indexbox_top">
    <div class="indexbox_top_title">
        <h2 class="indexbox_left_title_diy"><a>最新攻略心得</a></h2>
    </div>
    <div class="indexbox_top_gx">
        <ul>
        <?php foreach ($articleList as $key => $article) {?>
            <li><p><a href="<?php echo Yii::app()->createUrl('show/article', array('id' => $article->ArticleOne->id, 'pinyin' => $article->CateOne->pinyin));?>" target="_blank"><?php echo Helper::truncate_utf8_string($article->ArticleOne->title, 17, '...');?></a></p></li>

        <?php }?>
        </ul>
    </div>

</div>
</div>

    <div class="pages">
            <?php $this->widget('CLinkPager', array('pages' => $pages, 'cssFile' => false, 'header' => '', 'htmlOptions' => array('class' => 'mypage')));?>
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