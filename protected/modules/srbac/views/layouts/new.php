<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新娘街后台管理系统</title>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/js/ymPrompt/skin/qq/ymPrompt.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/ymPrompt/ymPrompt.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/ymPrompt/ymPrompt_Ex.js"></script>
</head>
<body>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    <div id="sidebar-wrapper">
      <!-- Sidebar with logo and menu -->
      <h1 id="sidebar-title"><a href="#">新娘街后台管理系统</a></h1>
      <!-- Logo (221px wide) -->
      <a href="/"><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/static/resources/images/logo.png" alt="Simpla Admin logo" /></a>
      <!-- Sidebar Profile links -->
      <div id="profile-links"> 你好, <a href="javascript:void(0)" title="Edit your profile"><?php echo Yii::app()->controller->module->getComponent('user')->name; ?></a><!-- , 你 有 <a href="#messages" rel="modal" title="3 Messages">3 条信息</a> --><br />
        <br />

        <?php 
          $ProductMemberComment=ProductMember::model()->findAll('top=1 and validate=0 and belongid='.Yii::app()->controller->module->getComponent('user')->binduserid);
          $num=count($ProductMemberComment);
          
        ?>
        <?php if($num>0){?>
         <a href="/srbac/gwyygl/admin" class="cbf" title="View the Site"><b><?php echo $num ?></b></a> | 
        <?php }  ?>
        <a href="/" title="View the Site">查看站点</a> | <a href="<?php echo $this->createUrl('/srbac/default/logout'); ?>" title="退 出">退 出</a> </div>
        <?php $this->widget('application.widget.srbac.menuWidget'); ?>
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
      &#169; Copyright 2014 新娘街 | Powered by <a href="#">新娘街</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>