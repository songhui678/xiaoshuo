<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>好尔后台管理系统</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/resources/logincss/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/resources/logincss/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/resources/logincss/invalid.css" type="text/css" media="screen" />
</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top" style="padding-top:100px">
    <h1>Simpla Admin</h1>
    <!-- Logo (221px width) -->
    <a href="#"><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/static/houtai/resources/images/logo.png" alt="Simpla Admin logo" /></a> </div>
  <!-- End #logn-top -->
  <div id="login-content">
      <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
          'validateOnSubmit'=>true,
        ),
      )); ?>
      <div class="notification information png_bg">
        <div>
          请输入用户名和密码
          <?php echo $form->error($model,'username'); ?>
          <?php echo $form->error($model,'password'); ?>
          <?php echo $form->error($model,'rememberMe'); ?>
        </div>
      </div>
      <p>
        <label><?php echo $form->labelEx($model,'username'); ?></label>
        <?php echo $form->textField($model,'username',array('class','text-input')); ?>
      </p>
      <div class="clear"></div>
      <p>
        <label><?php echo $form->labelEx($model,'password'); ?></label>
        <?php echo $form->passwordField($model,'password',array('class','text-input')); ?>
      </p>
      <div class="clear"></div>

      <div class="clear"></div>
      <p>
        <?php echo CHtml::submitButton('登 录',array('class'=>'button')); ?>
      </p>
    <?php $this->endWidget(); ?>
  </div>
  <!-- End #login-content -->
</div>
<!-- End #login-wrapper -->
</body>
</html>