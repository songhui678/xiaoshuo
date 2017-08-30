<?php

class WeixinController extends Controller
{

    public function init()
    {
        require_once Yii::app()->basePath . '/snoopy.class.php';
    }
    public function actionIndex()
    {

        $catelink = "http://weixin.sogou.com/weixin?query=%E5%B0%8F%E6%99%BA%E8%A7%A3%E8%AF%B4lol&_sug_type_=&_sug_=n&type=2&page=2&ie=utf8";
        $snoopy   = new Snoopy;
        $snoopy->fetch($catelink); //获取内容
        $weixinUrl = $snoopy->results;
        $weixinUrl = preg_replace('/\r|\n/', '', $weixinUrl);
        $weixinUrl = preg_replace('<em>', '', $weixinUrl);
        $weixinUrl = preg_replace('</em>', '', $weixinUrl);
        $weixinUrl = preg_replace('<!--red_beg-->', '', $weixinUrl);
        $weixinUrl = preg_replace('<!--red_end-->', '', $weixinUrl);
        $weixinUrl = trim(str_replace("<>", "", $weixinUrl));
        $weixinUrl = trim(str_replace("</>", "", $weixinUrl));
        $weixinUrl = trim(str_replace("<i></i>", "", $weixinUrl));

        preg_match_all('|<li id=\"(.*?)\" d=\"(.*?)\">(.*?)<\/li>|', $weixinUrl, $content);
        if (isset($content[0])) {
            foreach ($content[0] as $k => $v) {
                preg_match_all('|<a data-z=\"art\" target=\"_blank\" id=\"(.*?)\" href=\"(.*?)\" uigs=\"(.*?)\"><img src=\"(.*?)\" onload=\"(.*?)\" onerror=\"(.*?)\"><\/a>|', $v, $imgBox);
                var_dump($imgBox);
                preg_match_all('|<a target=\"_blank\" href=\"(.*?)\" id=\"(.*?)\" uigs=\"(.*?)\">(.*?)<\/a><\/h3><p class=\"txt-info\" id=\"(.*?)\">(.*?)<\/p>|', $v, $txtBox);
                var_dump($txtBox);exit;

            }
        }

        $this->render('index', $url);
    }

}
