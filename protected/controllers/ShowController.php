<?php

class ShowController extends Controller
{
    public $layout = 'xiaozhi';

    public function actionIndex()
    {
        $article_id = Yii::app()->request->getParam('id');
        $pinyin     = Yii::app()->request->getParam('pinyin');
        $cate       = Cate::model()->find("pinyin='" . $pinyin . "'");
        $article    = Article::model()->find("id=" . $article_id);

        $tuijianarticle = ArticleCateRelation::model()->findAll(array('condition' => "validate = 0 and type=0 and cate_id=" . $article->cate_id, 'order' => 'id desc', 'group' => 'article_id', 'limit' => 10));
        if (empty($article) || ($article->cate_id != $cate->id)) {
            $msg = '没有此视频';
            $this->render('error', compact('msg'));
        }
        $article->click_total += 1;
        $article->save(false);
        $NextArticle = article::model()->findAll(array('select' => 'id,title', 'condition' => 'validate = 0 and type=0 and  cate_id=:cate_id and id>' . $article_id, 'limit' => 1, 'params' => array(':cate_id' => $article->cate_id)));

        $BeforeArticle = article::model()->findAll(array('select' => 'id,title', 'condition' => 'validate = 0 and type=0 and  cate_id=:cate_id and id<' . $article_id, 'order' => 'id desc', 'limit' => 1, 'params' => array(':cate_id' => $article->cate_id)));
        if (empty($NextArticle)) {
            $NextArticle = array(0 => $article);
        }

        if (empty($BeforeArticle)) {
            $BeforeArticle = array(0 => $article);
        }

        //seo TDK
        $this->title       = $article->title . "-解说lol";
        $this->keywords    = "解说lol," . $cate->title . "解说," . $cate->title . "解说lol全集," . $cate->title . "解说2017最新视频,解说lol视频大全";
        $this->description = "解说lol,网络最全的解说lol视频网站,整合网络上解说lol,做最全的解说lol网站";

        $this->render('show', compact('article', 'cate', 'tuijianarticle', 'NextArticle', 'BeforeArticle'));
    }

    public function actionArticle()
    {
        $article_id = Yii::app()->request->getParam('id');
        $pinyin     = Yii::app()->request->getParam('pinyin');
        $cate       = Cate::model()->find("pinyin='" . $pinyin . "'");
        $article    = Article::model()->find("id=" . $article_id);

        $tuijianarticle = ArticleCateRelation::model()->findAll(array('condition' => "validate = 0 and cate_id=" . $article->cate_id, 'order' => 'id desc', 'group' => 'article_id', 'limit' => 10));
        if (empty($article)) {
            $msg = '没有此文章';
            $this->render('error', compact('msg'));
        }
        //seo TDK
        $this->title       = $article->title . "-解说lol";
        $this->keywords    = "解说lol," . $cate->title . "解说," . $cate->title . "解说lol全集," . $cate->title . "解说2017最新视频,解说lol视频大全";
        $this->description = "解说lol,网络最全的解说lol视频网站,整合网络上解说lol,做最全的解说lol网站";
        $this->render('article', compact('article', 'cate', 'tuijianarticle'));
    }

    public function actionReply()
    {
        $article_id = $_POST['ArticleReply']['article_id'];

        $article = Article::model()->find("id=" . $article_id);
        $cate    = Cate::model()->find("id=" . $article->cate_id);
        $model   = new ArticleReply;
        if (!empty($_POST['ArticleReply'])) {
            $model->attributes = $_POST['ArticleReply'];
            $model->creat_ip   = Yii::app()->request->userHostAddress;
            $model->add_time   = date('Y-m-d H:i:s', time());
            $model->valiate    = 0;
            if ($model->save(false)) {
                $article->reply_total += 1;
                $article->save(false);
            }
            $this->render('post');
        }

        $this->render('article', compact('article', 'cate', 'tuijianarticle'));
    }
}
