<?php

class SiteController extends Controller {
	public $layout = 'xiaozhi';
	public $tu_path = "/upload/photo/";
	public function init() {
		require_once Yii::app()->basePath . '/Snoopy.class.php';
	}
	public function actionIndex() {

		// $cateList = Cate::model()->findAll("validate=0 and tuijian=1");
		$cate = 2; //小智
		//       $articleRelationList=ArticleCateRelation::model()->findAll('validate=0 and type=0 and tuijian=1 and cate_id='.$cate);

		// $articleRelationCount = ArticleCateRelation::model()->count("validate=0 and type=0 and  tuijian=1 and cate_id=".$cate);

		//晒单列表
		$articleList = ArticleCateRelation::model()->findAll(array('condition' => "validate = 0 and tuijian=1 and type=0 and cate_id=" . $cate, 'order' => 'published_time desc', 'group' => 'article_id', 'limit' => 200));
		//seo TDK
		$this->title = "解说lol_小智解说lol全集_小智解说2017最新视频_解说直播lol视频大全";
		$this->keywords = "解说lol,直播lol,小智解说,小智解说lol全集,小智解说2017最新视频,解说lol视频大全";
		$this->description = "解说lol,网络最全的解说直播lol视频网站,整合网络上解说lol,做最全的解说lol网站";

		$this->render('index', array('articleList' => $articleList));
	}

	public function actionArticle() {

		$articleList = Article::model()->findAll(array('condition' => "cate_id=22", 'limit' => 500, 'offset' => 500));
		foreach ($articleList as $key => $article) {
			$youkujson = new YoukuUtils;
			$youku_json = $youkujson->getYk($article->video);
			$image_url = Helper::GrabImage($youku_json['img']);
			if ($article) {
				$article->image_url = $image_url;
				$article->published_time = $youku_json['published_time'];
				$article->save(false);
			}
		}

		echo $youkuurl . '--------success';
	}

	public function actionYouku() {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		date_default_timezone_set('Asia/Shanghai');

		$cateList = Cate::model()->findAll(array('condition' => "father_id=1 and validate=0"));
		// $cateList = Cate::model()->findAll(array('condition' => "id=2 and validate=0"));
		foreach ($cateList as $key => $cate) {
			$url = $cate->video_url;
			if (empty($url)) {
				break;
			}
			//http://i.youku.com/i/UMzU3MjkzOTI0/videos?order=1&page=2&last_item=50
			for ($page_num = 1; $page_num <= 1; $page_num++) {
				$link = "http://i.youku.com/i/%s/videos?order=1&page=%d";
				$catelink = vsprintf($link, array($url, $page_num));
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

						$youkujson = new YoukuUtils;
						$youku_json = $youkujson->getYk($url_id[0]);

						$articlett = Article::model()->find("title like '%" . $youku_json['title'] . "%'");
						if (empty($articlett)) {
							//获取图片并上传服务器
							$image_url = Helper::GrabImage($youku_json['img']);
							$articledb = new Article();
							$articledb->title = $youku_json['title'];
							$articledb->video_time = intval($youku_json['seconds'] / 60);
							$articledb->video = $url_id[0];
							$articledb->cate_id = $cate->id;
							$articledb->type = 0; //0=视频，1文章
							$articledb->validate = 0;
							$articledb->published_time = $youku_json['published_time'];
							$articledb->add_time = date("Y-m-d H:i:s", time());
							$articledb->update_time = date("Y-m-d H:i:s", time());
							$articledb->tuijian = 1; //0不推荐，1推荐
							$articledb->image_url = $image_url;
							if ($articledb->save(false)) {
								//分类关联文章
								$caterelation = new ArticleCateRelation();
								$caterelation->article_id = $articledb->id;
								$caterelation->father_id = $cate->father_id;
								$caterelation->cate_id = $cate->id;
								$caterelation->add_time = date("Y-m-d H:i:s", time());
								$caterelation->published_time = $youku_json['published_time'];
								$caterelation->validate = 0;
								$caterelation->tuijian = 1; //0不推荐，1推荐
								$caterelation->type = 0; //0=视频，1文章
								$caterelation->save(false);
							}
						}

					}
					unset($content);
				}
			}
		}
		echo $act . '--------success';
	}
	//sitemap
	public function actionSitemaptoxml() {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		date_default_timezone_set('Asia/Shanghai');
		//最新帖子
		$cateList = Cate::model()->findAll(array('condition' => "validate=0 and father_id=1"));

		$doc = new DOMDocument('1.0', 'utf-8'); // 声明版本和编码
		//生成xml
		$doc->formatOutput = true;
		$r = $doc->createElement("urlset");
		$doc->appendChild($r);

		foreach ($cateList as $k => $cate) {

			$Article = article::model()->findAll(array('select' => 'id,title,cate_id,published_time', 'condition' => 'validate = 0 and type=0 and  cate_id=:cate_id', 'order' => 'published_time desc', 'limit' => '3000', 'offset' => '0', 'params' => array(':cate_id' => $cate->id)));
			foreach ($Article as $key => $value) {
				$b = $doc->createElement("url");

				$loc = $doc->createElement("loc");
				//$city= City::model()->youxiao()->find(array('condition'=>"id ='".$value['cityId']."'"));
				$loc->appendChild($doc->createTextNode('http://www.jieshuolol.com/' . $cate->pinyin . '/' . $value->id . '.html'));
				$b->appendChild($loc);

				$lastmod = $doc->createElement("lastmod");
				$utime = substr($value->published_time, 0, 10);
				$lastmod->appendChild($doc->createTextNode($utime));
				$b->appendChild($lastmod);

				$changefreq = $doc->createElement("changefreq");
				$changefreq->appendChild($doc->createTextNode('always'));
				$b->appendChild($changefreq);

				$priority = $doc->createElement("priority");
				$priority->appendChild($doc->createTextNode('1.0'));
				$b->appendChild($priority);
				$r->appendChild($b);

				// if($key%100==0){
				//   sleep(2);
				// }
			}
		}

		$doc->save("sitemap.xml"); #保存路径
		echo "sitemap生成成功。。。。";
	}
}
