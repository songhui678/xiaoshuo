<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
date_default_timezone_set('Asia/Shanghai');

class XiaozhiCommand extends CConsoleCommand
{

    public function actionYouku()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');
        date_default_timezone_set('Asia/Shanghai');
        $cateList = Cate::model()->findAll(array('condition' => "father_id=1 and validate=0"));
        foreach ($cateList as $key => $cate) {
            $url = $cate->video_url;
            if (empty($url)) {
                break;
            }
            //http://i.youku.com/i/UMzU3MjkzOTI0/videos?order=1&page=2&last_item=50
            for ($page_num = 1; $page_num <= 1; $page_num++) {
                $link     = "http://i.youku.com/i/%s/videos?order=1&page=%d";
                $catelink = vsprintf($link, array($url, $page_num));
                print_r($catelink);

                /**
                $snoopy = new Snoopy;
                $snoopy->fetch($catelink); //获取内容
                $youkuUrl = $snoopy->results;
                $youkuUrl = preg_replace('/\r|\n/', '', $youkuUrl);
                preg_match_all('|<div class=\"v-meta\">(.*?)<\/div>|', $youkuUrl, $content);
                if ($content) {
                foreach ($content[0] as $k => $v) {
                $content[0][$k] = preg_replace('<div class="v-meta">', '', $v);
                $content[0][$k] = preg_replace('<div class="v-meta-title">', '', $content[0][$k]);
                $content[0][$k] = preg_replace('<>', '', $content[0][$k]);
                $content[0][$k] = str_replace("</div>", "", $content[0][$k]);
                $content[0][$k] = trim(str_replace("<>", "", $content[0][$k]));

                $url_id = explode('id_', $content[0][$k]);
                //_XNTEzNTkxMjYw.html
                $url_id = explode('.html', $url_id[1]);

                $youkujson  = new YoukuUtils;
                $youku_json = $youkujson->getYk($url_id[0]);

                $articlett = Article::model()->find("title like '%" . $youku_json['title'] . "%'");
                if (empty($articlett)) {
                //获取图片并上传服务器
                $image_url                 = Helper::GrabImage($youku_json['img']);
                $articledb                 = new Article();
                $articledb->title          = $youku_json['title'];
                $articledb->video_time     = intval($youku_json['seconds'] / 60);
                $articledb->video          = $url_id[0];
                $articledb->cate_id        = $cate->id;
                $articledb->type           = 0; //0=视频，1文章
                $articledb->validate       = 0;
                $articledb->published_time = $youku_json['published_time'];
                $articledb->add_time       = date("Y-m-d h:i:s", time());
                $articledb->update_time    = date("Y-m-d h:i:s", time());
                $articledb->tuijian        = 1; //0不推荐，1推荐
                $articledb->image_url      = $image_url;
                if ($articledb->save(false)) {
                //分类关联文章
                $caterelation                 = new ArticleCateRelation();
                $caterelation->article_id     = $articledb->id;
                $caterelation->father_id      = $cate->father_id;
                $caterelation->cate_id        = $cate->id;
                $caterelation->add_time       = date("Y-m-d h:i:s", time());
                $caterelation->published_time = $youku_json['published_time'];
                $caterelation->validate       = 0;
                $caterelation->tuijian        = 1; //0不推荐，1推荐
                $caterelation->type           = 0; //0=视频，1文章
                $caterelation->save(false);
                }
                }
                sleep(1);
                }
                }
                sleep(1);
                 **/
            }
        }

        echo '--------success';
    }
}
