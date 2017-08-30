<?php

class PublicController extends Controller {
	public $time;
	public function init() {
		// Yii::app()->clientScript->registerCssFile(CSS_PATH.'common.css');
		parent::init();
		$this->time = date('Y-m-d H:i:s', time());
	}
	public function actions() {
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF, //背景颜色
				'minLength' => 4, //最短为4位
				'maxLength' => 4, //是长为4位
				'transparent' => true, //显示为透明，当关闭该选项，才显示背景颜色
			),
		);
	}
	public function actionIndex() {
		$this->render('index');
	}

	public function actionLogin() {
		$referer = Yii::app()->request->getParam('referer');
		$referer = $referer ? $referer : Yii::app()->request->urlReferrer;

		if (!Yii::app()->user->isGuest) {
			$this->redirect($referer); //未登录跳转页面
		}

		if (!empty($referer)) {
			$cookie = new CHttpCookie('referer', $referer);
			$cookie->expire = time() + 60 * 60 * 24; //有限期30天
			$cookie->value = $referer;
			Yii::app()->request->cookies['referer'] = $cookie;
		}

		Yii::app()->clientScript->registerScriptFile(JS_PATH . 'jquery-1.7.1.min.js');
		Yii::app()->clientScript->registerScriptFile(JS_PATH . 'jquery.form.js');
		$model = new LoginForm;

		$model->rememberMe = 1;

		if (!empty($_POST['LoginForm'])) {

			//赋值给模型
			$model->attributes = $_POST['LoginForm'];
			//获取验证错误
			$ajaxRes = CActiveForm::validate($model, array('username', 'password', 'rememberMe'));
			$ajaxResArr = CJSON::decode($ajaxRes);
			//验证结果为空入库
			if (empty($ajaxResArr)) {
				if ($model->validate() && $model->login()) {
					scoreAction::setScore(Yii::app()->user->id, 'denglu', 'add', false); //登陆加积分
					die(CJSON::encode(array('status' => 1)));
				} else {
					die(CJSON::encode(array('status' => 0)));
				}
			} else {
				die($ajaxRes);
			}
		}

		//seo TDK
		$this->title = "用户登录 -解说lol";
		$this->keywords = "";
		$this->description = "";
		$this->render('login', array('model' => $model));
	}
	//退出登陆
	public function actionLogout() {
		$referer = Yii::app()->request->getParam('referer');
		$referer = $referer ? $referer : Yii::app()->request->urlReferrer;
		$referer = false !== strpos($referer, 'jihuoma') ? Yii::app()->homeUrl : $referer;
		Yii::app()->user->logout(false);
		$this->redirect($referer);
	}

	public function actionJihuo() {
		$uid = Yii::app()->user->id;
		$memberModel = Member::model()->find("id = {$uid}");
		$this->render('jihuo');
	}

	//首页注册
	public function actionRegindex() {
		Yii::app()->clientScript->registerScriptFile('/js/jquery.form.js');

		$this->pageKeyword['title'] = Helper::siteConfig()->site_name . '-注册';
		$this->pageKeyword['keywords'] = Helper::siteConfig()->site_name . '-注册';
		$this->pageKeyword['description'] = Helper::siteConfig()->site_name . '-注册';

		//实例化用户模型
		$memberModel = new Member;
		if (!empty($_POST['Member'])) {
			//赋值给模型
			$memberModel->attributes = $_POST['Member'];
			//验证
			$ajaxRes = CActiveForm::validate($memberModel, array('username', 'password', 'passwordrepeat', 'tiaokuan'));
			$ajaxResArr = CJSON::decode($ajaxRes);
			//验证结果
			if (empty($ajaxResArr)) {

				$score = Score::model()->find('id=1');
				$memberModel->nickname = $memberModel->username;
				$memberModel->salt = Helper::randomCode(); //加盐值
				$memberModel->password = $memberModel->hashPassword(); //密码
				$memberModel->create_time = time(); //创建时间
				$memberModel->update_time = time(); //更新时间
				$memberModel->status = 1; //状态
				$memberModel->role_id = 1; //状态
				$memberModel->photo = rand(1, 95) . '.jpg'; //头像
				$memberModel->last_login_time = time(); //登陆时间
				$memberModel->last_login_ip = Yii::app()->request->UserHostAddress; //IP地址
				$memberModel->score = $score->zhuce; //注册积分
				$memberModel->status = 2;
				$memberModel->jihuoma = md5($memberModel->username . time());
				$memberModel->save(false);
				//创建用户积分
				$memberModel->createrScore();

				//直接登录
				$account = $memberModel->username;
				$identity = new UserIdentity($account, $memberModel->password, true);
				$identity->authenticate();
				$duration = 0;
				Yii::app()->user->login($identity, $duration);
				//发送激活邮件
				//Helper::SendEmail($memberModel->username,'解说lol-激活邮件',$memberModel->username.' 您好，请点击 http://www.jieshuolol.com/public/register?jihuoma='.$memberModel->jihuoma.' 激活您的解说lol账号！');
				$content = "亲爱的用户，欢迎您加入解说lol! 请点击此链接  http://www.jieshuolol.com/public/register?jihuoma={$memberModel->jihuoma} 完成注册 ，如果此链接无法点击，请将此地址复制到你的浏览器(如IE)的地址栏进入解说lol。(注：这是一封自动产生的email，请勿回复。)";
				Helper::SendEmail($memberModel->username, '解说lol-激活邮件', $content);
				die(CJSON::encode(array('status' => 1)));
			} else {
				die($ajaxRes);
			}

		}

		//seo TDK
		$this->title = "用户注册 -解说lol";
		$this->keywords = "";
		$this->description = "";
		$this->render('register', array('memberModel' => $memberModel));
	}

	public function actionChongxin() {
		$uid = Yii::app()->user->id;
		$memberModel = Member::model()->find("id = {$uid}");
		//$res = Helper::SendEmail($memberModel->username,'解说lol-激活邮件',$memberModel->username.' 您好，请点击 http://www.jieshuolol.com/public/jihuo 激活您的解说lol账号！');
		$content = "亲爱的用户，欢迎您加入解说lol! 请点击此链接  http://www.jieshuolol.com/public/register?jihuoma={$memberModel->jihuoma} 完成注册 ，如果此链接无法点击，请将此地址复制到你的浏览器(如IE)的地址栏进入解说lol。(注：这是一封自动产生的email，请勿回复。)";
		Helper::SendEmail($memberModel->username, '解说lol-激活邮件', $content);
	}

	//注册
	public function actionRegister() {
		if (Yii::app()->user->isGuest) {
			$jihuoma = Yii::app()->request->getParam('jihuoma');
			if (empty($jihuoma)) {
				$this->redirect('/');
			}

			$memberModel = Member::model()->find("jihuoma = '{$jihuoma}'");

			if (empty($memberModel)) {
				$this->redirect('/');
			}
			$account = $memberModel->username;
			$identity = new UserIdentity($account, $memberModel->password, true);
			$identity->authenticate();
			$duration = 0;
			Yii::app()->user->login($identity, $duration);
		} else {
			/*$referer = Yii::app()->request->getParam('referer');
		$referer = $referer ? $referer : Yii::app()->request->urlReferrer;
		$this->redirect($referer);*/
		}

		Yii::app()->clientScript->registerScriptFile('/js/jquery.form.js');

		$this->pageKeyword['title'] = Helper::siteConfig()->site_name . '-注册';
		$this->pageKeyword['keywords'] = Helper::siteConfig()->site_name . '-注册';
		$this->pageKeyword['description'] = Helper::siteConfig()->site_name . '-注册';

		//实例化用户模型
		$uid = Yii::app()->user->id;
		$memberModel = Member::model()->find("id = {$uid}");

		if (!empty($_POST['Member'])) {
			//赋值给模型
			$memberModel->attributes = $_POST['Member'];
			//验证
			$ajaxRes = CActiveForm::validate($memberModel, array('phone', 'nickname', 'province', 'city', 'industry', 'gongsi', 'zhiwu', 'tag', 'lingyu', 'verifyCode'));
			$ajaxResArr = CJSON::decode($ajaxRes);
			//验证结果
			if (empty($ajaxResArr)) {

				$score = Score::model()->find('id=1');

				//$memberModel->salt=Helper::randomCode();//加验证
				//$memberModel->password=$memberModel->hashPassword();//密码
				//$memberModel->create_time=time();//创建时间
				$memberModel->update_time = time(); //更新时间
				$memberModel->status = 1; //状态
				$memberModel->role_id = 1; //状态
				$memberModel->photo = rand(1, 95) . '.jpg'; //头像
				$memberModel->last_login_time = time(); //登陆时间
				$memberModel->last_login_ip = Yii::app()->request->UserHostAddress; //IP地址
				$memberModel->score = $score->zhuce; //注册积分
				$memberModel->save(false);
				//创建用户积分
				$memberModel->createrScore();

				//直接登录
				$account = $memberModel->username;
				$identity = new UserIdentity($account, $memberModel->password, true);
				$identity->authenticate();
				$duration = 0;
				Yii::app()->user->login($identity, $duration);

				die(CJSON::encode(array('status' => 1)));
			} else {
				die($ajaxRes);
			}

		}

		//seo TDK
		$this->title = "用户注册 -解说lol";
		$this->keywords = "";
		$this->description = "";
		$this->render('register', array('memberModel' => $memberModel));

	}

	//qq登陆
	public function actionQqlogin() {
		Yii::import('ext.oauthlogin.qq.qqConnect', true);
		$code = Yii::app()->request->getParam('code');
		$state = Yii::app()->request->getParam('state');
		$qqService = new qqConnectAuthV2(QQ_APPID, QQ_APPKEY);
		$type = 'code';

		$keys['code'] = $code;
		$keys['state'] = $state;
		$keys['redirect_uri'] = QQ_CALLBACK_URL;
		$res = $qqService->getAccessToken($type, $keys);

		$params['access_token'] = $res['access_token'];
		$params['openid'] = $res['openid'];
		$userinfo = $qqService->getUserInfo($params);

		$name = $userinfo['nickname'];
		if (!empty($res['access_token'])) {
			$accessToken = $res['access_token'];
			$openId = $res['openid'];
			$model = AuthorConnector::model()->find("openId = :openId and source = 'qq' and validate = 0", array(":openId" => $openId));
			if (empty($model)) {
				$source = 'qq';
				//新用户,设置session,跳转到注册页面
				Yii::app()->session->add('otherlogin', compact('accessToken', 'openId', 'source', 'userinfo', 'name'));
				//$loginForm = new OloginForm;
				//$loginForm->adduser();
				//跳转到完善信息页
				$this->redirect(array('/public/info'));
			} else {
				//登录
				$this->login($model, $res);
			}
		} else {
			$this->redirect(array('/'));
		}
	}
	private function login($model, $res) {
		//先验证用户失效
		$user = User::model()->findByPk($model->userId);
		if (!$user->state) {
			echo '<script>alert("由于某些原因，您已被系统拒绝登录\r\n请联系客服电话:400-0365-081 ，找到回来的路。");location.href="' . Yii::app()->request->hostInfo . '"</script>';
			exit;
		}
		//记录登陆时间到登陆时间表
		$record = new CustomerLoginRecord;
		$record->user_id = $record->created_by = $user->id;
		$record->logintime = $record->created = $this->time;
		$ip = My::get_ip();
		if ($ip) {
			$record->loginip = $ip;
		} else {
			$record->loginip = '';
		}

		$record->if_publish = $record->if_agreed_on = $record->if_upload_invoice = 0;
		$record->state = 1;
		$record->save();

		//更新token
		$model->accessToken = $res['access_token'];
		$model->save(false);
		$identity = new UserIdentity($model->openId, $model->accessToken, true);
		$identity->authenticate();
		$duration = 0;
		Yii::app()->user->login($identity, $duration);
		if (!empty(Yii::app()->session['redirect_url'])) {
			$this->redirect(Yii::app()->session['redirect_url']);
		} else {
			$this->redirect(array('/user'));
		}

	}
	//sina登陆
	public function actionWblogin() {

		Yii::import('ext.oauthlogin.sina.sinaWeibo', true);
		$code = Yii::app()->request->getParam('code');
		$state = Yii::app()->request->getParam('state');
		$weiboService = new SaeTOAuthV2(WB_AKEY, WB_SKEY);
		$type = 'code';
		$keys['code'] = $code;
		$keys['state'] = $state;
		$keys['redirect_uri'] = WB_CALLBACK_URL;
		$res = $weiboService->getAccessToken($type, $keys);
		$params['access_token'] = $res['access_token'];
		$params['openid'] = $res['uid'];
		$weiboServiceDetail = new SaeTClientV2(WB_AKEY, WB_SKEY, $res['access_token']);
		$userinfo = $weiboServiceDetail->getUserShow($res);
		$name = isset($userinfo['name']) ? $userinfo['name'] : '新浪用户';
		if (!empty($res['access_token'])) {
			$accessToken = $res['access_token'];
			$openId = $res['uid'];
			$source = 'sina';
			$model = AuthorConnector::model()->find("openId = :openId and source = 'sina' and validate = 0", array(":openId" => $openId));
			if (empty($model)) {
				//新用户,设置session,跳转到注册页面
				Yii::app()->session->add('otherlogin', compact('accessToken', 'openId', 'source', 'userinfo', 'name'));
				//$loginForm = new OloginForm;
				//$loginForm->adduser(); //添加新用户并且登陆
				$this->redirect(array('/public/info'));
			} else {
				//登录
				$this->login($model, $res);
			}
		} else {
			$this->redirect(array('site/index'));
		}
	}

	public function actionDeltopic() {
		$oid = Yii::app()->request->getParam('oid');

		if (!Yii::app()->user->isGuest) {
			$data = Topic::model()->find("id = {$oid} and uid = " . Yii::app()->user->id);
			if (!empty($data)) {
				$data->delete();
			}
		}
	}

	public function actionForget() {
		Yii::app()->clientScript->registerCssFile('/static/css/jigou.css');
		Yii::app()->clientScript->registerCssFile('/static/css/sousuo.css');
		Yii::app()->clientScript->registerCssFile('/static/css/pages.css');

		$model = new Member();
		if (isset($_POST['Member'])) {
			$post = $_POST['Member'];
			$member = Member::model()->find(array(
				'condition' => 'username = :username',
				'params' => array(':username' => $post['username']),
			));
			if (null == $member) {
				$this->error('账号不存在!');
			}
			$encrypt = new Encrypt();
			$passkey = $member->username . '|' . (time() + 7200);
			$passkey = $encrypt->encode($passkey);
			$member->passkey = $passkey;
			$member->save(false);

			$url = $this->createUrl('public/getpass', array('key' => $passkey));
			$message = "亲爱的{$member->username}：欢迎使用解说lol找回密码功能。<br>点击下面链接修改密码<br>{$url}";
			Helper::SendEmail($member->username, '解说lol密码找回', $message, '解说lol');

			$this->success('已经向您的邮箱发送了密码找回的邮件!');
			return;
		}
		$this->render('forget', compact('model'));
	}

	public function actionGetpass() {
		Yii::app()->clientScript->registerCssFile('/static/css/jigou.css');
		Yii::app()->clientScript->registerCssFile('/static/css/sousuo.css');
		Yii::app()->clientScript->registerCssFile('/static/css/pages.css');

		$key = Yii::app()->request->getParam('key');
		if (null == $key) {
			$this->redirect(array('site/index'));
		}

		$member = Member::model()->find(array(
			'condition' => 'passkey = :passkey',
			'params' => array(':passkey' => $key),
		));
		if (null == $member) {
			$this->render('error', array('msg' => '找回密码链接貌似已过期!'));
			return;
		}

		$encrypt = new Encrypt();
		$dekey = $encrypt->decode($key);
		if (strpos($dekey, '|') === false) {
			$this->render('error', array('msg' => '密匙异常!'));
			return;
		}
		$keys = explode('|', $dekey);
		list($username, $expire) = $keys;

		if ($username != $member->username || time() > $expire) {
			$this->render('error', array('msg' => '密匙错误或已过期!'));
			return;
		}

		if (isset($_POST['Member'])) {
			$member->attributes = $_POST['Member'];
			$member->salt = Helper::randomCode(); //加盐值
			$member->password = md5($member->password . $member->salt); //密码
			$member->passkey = '';
			$member->save(false);
			$this->success();
			return;
		}
		$this->render('getpass', compact('member'));
	}

	public function actionGettag() {
		$pid = Yii::app()->request->getParam('pid');
		$data = Tag::model()->findAll("pid = {$pid}");

		foreach ($data as $value) {
			echo CHtml::tag('option', array('value' => $value->id), CHtml::encode($value->title), true);
		}
	}

	//注册或登录
	public function actionReg() {
		$this->layout = 'login';
		// 如果有邀请
		if (!empty($_GET['m'])) {
			$type = Yii::app()->request->getParam('type');
			$name = Yii::app()->request->getParam('name');
			$id = Yii::app()->request->getParam('id');
			// 先验证有效性，检测该链接是否被篡改过
			$param = '?id=' . $id . '&type=' . $type . '&name=' . $name;
			if ($_GET['m'] == md5('huasuhui_invite_friend' . $param)) {
				$type = My::urlsafe_b64decode($type);
				$sid = My::urlsafe_b64decode($id);
				$name = My::urlsafe_b64decode($name);
				Yii::app()->session->add('invite_info', compact('sid', 'type', 'name'));
				// My::test(Yii::app()->session['invite_info']);
			}
		}
		$this->render('reg');
	}

	//完善信息
	public function actionInfo() {
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientscript->scriptMap['jquery-1.7.1.min.js'] = false;
		$this->layout = 'login';
		$model = new Company;
		if (isset($_POST['Company'])) {
			if (isset($_POST['yt0'])) {
				$action = '/user/index';
			} else {
				$action = '/site/index';
			}
			//
			//先行验证表单数据
			$model->attributes = $_POST['Company'];
			$model->lianxiren = $_POST['Company']['lianxiren'];
			$model->mobile_phone = $_POST['Company']['mobile_phone'];
			if (!$model->validate(array('lianxiren', 'mobile_phone', 'company_name', 'yanzhengma'))) {
				My::ajax_return(0, My::get_errors($model));
				// $this->render('info',compact('model'));
				exit;
			}
			//
			$loginForm = new OloginForm;
			if ($loginForm->adduser($_POST['Company']['mobile_phone']) === false) {
				echo '<script>alert("长时间未完成注册导致授权信息失效，请重新选择第三方登陆。");location.href="' . $this->createUrl('public/reg') . '"</script>';
				exit;
			}
			$model = Company::model()->find("id = " . Yii::app()->user->id);
			$user = User::model()->find("company_id = " . Yii::app()->user->id);

			$model->attributes = $_POST['Company'];
			$model->lianxiren = $_POST['Company']['lianxiren'];
			$model->business_model = $_POST['Company']['business_model'];
			$model->mobile_phone = $_POST['Company']['mobile_phone'];
			$model->created = $model->lastupdated = $this->time;
			if ($res = $model->save(true, array('company_name', 'lianxiren', 'mobile_phone', 'yanzhengma', 'business_model'))) {

				$user->name = $model->lianxiren;
				$user->mobile_phone = $model->mobile_phone;
				if ($user->customer_source == 1) {
					$user->customer_source = 3;
					$user->regtime = $user->lastupdated = $this->time;
				} else {
					$user->created = $user->regtime = $user->lastupdated = $this->time;
				}

				$user->save(false);
				// 如果有邀请，则添加邀请记录
				if (!empty(Yii::app()->session['invite_info'])) {
					if (Yii::app()->session['invite_info']['type'] == 1) {
						$invited = new Invited;
						$invited->send_id = Yii::app()->session['invite_info']['sid'];
						$invited->receive_name = $user->name;
						$invited->send_type = 1;
						$invited->send_time = date('Y-m-d H:i:s', time());
					} elseif (Yii::app()->session['invite_info']['type'] == 2) {
						$invited = Invited::model()->find('send_id = ' . Yii::app()->session['invite_info']['sid'] . ' and receive_name="' . Yii::app()->session['invite_info']['name'] . '" and send_type = 2');
					}
					$invited->is_reg = 1;
					$invited->receive_id = $user->id;
					$invited->save();

					unset(Yii::app()->session['invite_info']);
				}

				Yii::app()->user->setState('user', $user);
				Yii::app()->user->setState('company', $model);

				// 生成微信绑定链接
				$wx_template = new WxTemplate;

				$re = $wx_template->getQRimg($user->id);

				//$this->redirect(array($action));
				My::ajax_return(1, $action, $re);
				exit;
			} else {
				My::ajax_return(0, My::get_errors($model));
				exit;
			}
			// }else{
			// 	$error = $model->getErrors();
			// 	var_dump($error);
			// }
		}

		$this->render('info', compact('model'));
	}

}