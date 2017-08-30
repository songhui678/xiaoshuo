<?php
/* @var $this TagsrelationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'表名称(新建模型需要在模型里面修改)',
);

$this->menu=array(
	array('label'=>'创建表名称(新建模型需要在模型里面修改)', 'url'=>array('create')),
	array('label'=>'管理表名称(新建模型需要在模型里面修改)', 'url'=>array('admin')),
);
?>

<h1>表名称(新建模型需要在模型里面修改)</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
