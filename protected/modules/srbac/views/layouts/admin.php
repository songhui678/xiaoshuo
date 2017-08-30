<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>好尔后台管理系统</title>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/css/invalid.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/js/jquery.form.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/js/ymPrompt/skin/qq/ymPrompt.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/js/ymPrompt/ymPrompt.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/js/ymPrompt/ymPrompt_Ex.js"></script>
</head>
<?php
      $userid = Yii::app()->controller->module->getComponent('user')->userid;
      $sql = 'SELECT * FROM `'.Yii::app()->params['tablePrefix'].'itemchildren` LEFT JOIN `'.Yii::app()->params['tablePrefix'].'items` ON child = NAME WHERE parent IN (SELECT itemname FROM `'.Yii::app()->params['tablePrefix'].'assignments` WHERE userid = '.$userid.') ORDER BY sort asc';

      $connection=Yii::app()->db; 
      $command=$connection->createCommand($sql);
      $menu=$command->queryAll();

      foreach ($menu as $key => $value) {
        $menu_res[unserialize($value['data'])][] = $value;
        if($value['child'] == Yii::app()->controller->id){
          $current = unserialize($value['data']);
        }
      }
      if(empty($current)) $current = '';
?>
<?php $i = 0; ?>
<?php
    if(!isset($selectedSid)){
        echo 'var selectedSid = 0;';
    }
?>
<body>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    <div id="sidebar-wrapper">
      <!-- Sidebar with logo and menu -->
      <h1 id="sidebar-title"><a href="#">好尔后台管理系统</a></h1>
      <!-- Logo (221px wide) -->
      <a href="/"><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/resources/images/logo.png" alt="Simpla Admin logo" /></a>
      <!-- Sidebar Profile links -->
      <div id="profile-links"> 你好, <a href="javascript:void(0)" title="Edit your profile"><?php echo Yii::app()->controller->module->getComponent('user')->name; ?></a><!-- , 你 有 <a href="#messages" rel="modal" title="3 Messages">3 条信息</a> --><br />
        <br />
        <a href="/srbac/gwyygl/admin" class="cbf" title="View the Site"><b><!--9999--></b></a> | 
       
        <a href="/" title="View the Site">查看站点</a> | <a href="<?php echo $this->createUrl('/srbac/default/logout'); ?>" title="退 出">退 出</a> </div>
        <ul id="main-nav">
          <?php foreach($menu_res as $key => $value){ ?>
          <li> <a href="javascript:void(0)" class="nav-top-item<?php if($key == $current){ echo ' current';} ?>">
            <?php echo $key; ?> </a> 
            <ul>
              <?php foreach($value as $k => $v){ ?>
              <li><a <?php if($v['child'] == Yii::app()->controller->id){ ?>class="current"<?php } ?> href="<?php echo Yii::app()->createUrl('/srbac/'.$v['child'].'/admin'); ?>"><?php echo $v['description']; ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
        </ul>
    </div>
  </div>
  <!-- End #sidebar -->
  <div id="main-content">
    <!-- Page Head -->
    <h2>欢迎回来，管理员</h2>
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3><?php $Items = Items::model()->find('name = :name and type = 1', array(':name'=>Yii::app()->controller->id));if(!empty($Items)) echo $Items->description; ?></h3>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
      <?php echo $content; ?>
      </div>
    </div>

    <div style="clear: both;">
    <?php
      if($this->id != 'authitem' && $this->id != 'default' && $this->id != 'sbase'){
        $this->beginWidget('zii.widgets.CPortlet', array(
          'title'=>'操作管理',
        ));
        $this->widget('zii.widgets.CMenu', array(
          'items'=>$this->menu,
          'htmlOptions'=>array('class'=>'operations'),
        ));
        $this->endWidget();
      }
    ?>
    </div><!-- sidebar -->
    <!-- End .content-box -->
    <div class="clear"></div>
    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2014 好尔 | Powered by <a href="#">好尔</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>