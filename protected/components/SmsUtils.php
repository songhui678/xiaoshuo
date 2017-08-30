<?php

class SmsUtils {

	// 短信接口案例：http://www.zucp.net/index.php/mesdkdown/1.html
	// sn:SDK-BBX-010-08543
	// pw:130459
	public static function send($phone, $msg, $ext = '') {
		//手机号处理
		$flag = 0;
		//要post的数据
		$argv = array();
		$argv['sn'] = 'SDK-BBX-010-23885';
		$argv['pwd'] = strtoupper(md5('SDK-BBX-010-23885' . ')d-3493-'));
		$argv['mobile'] = $phone; ////'18501258330',//手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
		$argv['content'] = $msg . '[绿能财]'; //iconv( "UTF-8", "gb2312//IGNORE" ,'您好测试短信xx[XXX公司]'),//短信内容
		$argv['ext'] = $ext;
		$argv['stime'] = ''; //定时时间 格式为2011-6-29 11:09:21
		$argv['msgfmt'] = '';
		$argv['rrid'] = time();
		//构造要post的字符串
		$params = '';
		foreach ($argv as $key => $value) {
			if ($flag != 0) {
				$params .= "&";
				$flag = 1;
			}
			$params .= $key . "=";
			$params .= urlencode($value);
			$flag = 1;
		}
		$length = strlen($params);

		//创建socket连接
		$fp = @fsockopen('sdk.entinfo.cn', 8061, $errno, $errstr, 5);
		if (!$fp) {
			return '网络异常';
		}
		//构造post请求的头
		$header = "POST /webservice.asmx/mdsmssend HTTP/1.1\r\n";
		$header .= "Host:sdk.entinfo.cn\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . $length . "\r\n";
		$header .= "Connection: Close\r\n\r\n";
		//添加post的字符串
		$header .= $params . "\r\n";

		//发送post的数据
		fputs($fp, $header);
		stream_set_timeout($fp, 30);
		$inheader = 1;
		while (!feof($fp)) {
			$line = fgets($fp, 1024); //去除请求包的头只显示页面的返回数据
			if ($inheader && ($line == "\n" || $line == "\r\n")) {
				$inheader = 0;
			}
		}
		$status = preg_replace('/<string [^<>]*?>(.*?)<\/string>/is', '$1', $line);
		var_dump($status);
		return $status;
	}

}
