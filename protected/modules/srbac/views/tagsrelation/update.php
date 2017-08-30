<?php
/* @var $this TagsrelationController */
/* @var $model TagsRelation */

$this->breadcrumbs=array(
	'表名称(新建模型需要在模型里面修改)'=>array('index'),
	$model->tag_id=>array('view','id'=>$model->tag_id),
	'Update',
);

$this->menu=array(
	array('label'=>'表名称(新建模型需要在模型里面修改)列表', 'url'=>array('index')),
	array('label'=>'创建表名称(新建模型需要在模型里面修改)', 'url'=>array('create')),
	array('label'=>'显示表名称(新建模型需要在模型里面修改)', 'url'=>array('view', 'id'=>$model->tag_id)),
	array('label'=>'管理表名称(新建模型需要在模型里面修改)', 'url'=>array('admin')),
);
?>

<h1>修改表名称(新建模型需要在模型里面修改) <?php echo $model->tag_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>