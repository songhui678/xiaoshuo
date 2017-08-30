<?php
/* @var $this TagsrelationController */
/* @var $data TagsRelation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tag_id), array('view', 'id'=>$data->tag_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_id')); ?>:</b>
	<?php echo CHtml::encode($data->article_id); ?>
	<br />


</div>