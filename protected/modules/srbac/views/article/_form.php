<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
)); ?>

	<p class="note">带*号的为必填项</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'summary'); ?>


	</div>
	<div class="row">
	    <?php echo $form->labelEx($model,'image_url'); ?>
	    <?php echo CHtml::activeFileField($model,'image_url'); ?>
	    <?php echo $form->error($model,'image_url'); ?>
	</div>
	<div class="row">
	<?php echo '图片预览' ?>
	<?php echo '<img src="http://img.jieshuolol.com/'.$model->image_url.'"  style="width:100px;height:100px;"/>' ?>
	</div>
	 
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'video_time'); ?>
		<?php echo $form->textField($model,'video_time',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'video_time'); ?>
	</div>
 

	<div class="row">
		<?php echo $form->labelEx($model,'video'); ?>
		<?php echo $form->textField($model,'video',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'video'); ?>
	</div>

 
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->TypeArr,array('empty'=>'-请选择-')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
 
 	<div class="row">
		<?php echo $form->labelEx($model,'cate_id'); ?>
		<?php echo $form->dropDownList($model,'cate_id',$model->CateArr,array('empty'=>'-请选择-')); ?>
		<?php echo $form->error($model,'cate_id'); ?>
	</div>
 	<div class="row"><br/></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->