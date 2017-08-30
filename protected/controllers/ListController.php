<?php

class ListController extends Controller
{
    public $layout = 'xiaozhi';

    public function actionIndex()
    {
        $pinyin           = Yii::app()->request->getParam('pinyin');
        $cate             = Cate::model()->find("pinyin='" . $pinyin . "'");
        $articlelistCount = ArticleCateRelation::model()->count(array('condition' => "validate = 0 and type=0 and cate_id=" . $cate->id, 'group' => 'article_id'));
        $pages            = new CPagination($articlelistCount);

        $pages->pageSize = 56; //分页显示条数
        $pages->pageVar  = 'page';

        $articleList = ArticleCateRelation::model()->findAll(array('condition' => "validate = 0 and type=0 and cate_id=" . $cate->id, 'order' => 'published_time desc', 'group' => 'article_id', 'limit' => $pages->pageSize, 'offset' => $pages->currentPage * $pages->pageSize));

        //seo TDK
        $this->title       = "解说lol_" . $cate->title . "解说lol全集_" . $cate->title . "解说2017最新视频_解说lol视频大全";
        $this->keywords    = "解说lol,直播lol," . $cate->title . "解说," . $cate->title . "解说lol全集," . $cate->title . "解说2017最新直播视频,解说lol视频大全";
        $this->description = "解说lol,网络最全的解说直播lol视频网站,整合网络上解说lol,做最全的解说lol网站";

        $this->render('list', compact('pages', 'cate', 'articleList', 'articlelistCount'));
    }

    public function actionArticle()
    {
        $pinyin           = Yii::app()->request->getParam('pinyin');
        $cate             = Cate::model()->find("pinyin='" . $pinyin . "'");
        $articlelistCount = ArticleCateRelation::model()->count(array('condition' => "validate = 0 and type=0 and cate_id=" . $cate->id, 'group' => 'article_id'));
        $pages            = new CPagination($articlelistCount);

        $pages->pageSize = 20; //分页显示条数
        $pages->pageVar  = 'page';
        //'type' => '文章类型',  //0=视频，1文章
        $articleList = ArticleCateRelation::model()->findAll(array('condition' => "validate = 0 and type=1 and cate_id=" . $cate->id, 'order' => 'published_time desc', 'group' => 'article_id', 'limit' => $pages->pageSize, 'offset' => $pages->currentPage * $pages->pageSize));

        //seo TDK
        $this->title       = "解说lol_" . $cate->title . "解说lol全集_" . $cate->title . "解说2015最新视频_lol攻略心得大全";
        $this->keywords    = "解说lol," . $cate->title . "解说," . $cate->title . "解说lol全集," . $cate->title . "解说2014最新视频,解说lol视频大全";
        $this->description = "解说lol,网络最全的解说lol视频网站,整合网络上解说lol,做最全的解说lol网站";

        $this->render('articlelist', compact('pages', 'cate', 'articleList', 'articlelistCount'));
    }

}
