<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'表名称(新建模型需要在模型里面修改)'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'表名称(新建模型需要在模型里面修改)列表', 'url'=>array('index')),
	array('label'=>'创建表名称(新建模型需要在模型里面修改)', 'url'=>array('create')),
	array('label'=>'修改表名称(新建模型需要在模型里面修改)', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除表名称(新建模型需要在模型里面修改)', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理表名称(新建模型需要在模型里面修改)', 'url'=>array('admin')),
);
?>

<h1>显示表名称(新建模型需要在模型里面修改) #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'ip',
		'add_time',
		'update_time',
		'last_time',
		'score',
		'name',
		'sex',
		'province',
		'city',
		'logo',
		'sign',
		'source',
		'mobile',
		'phone',
		'qq',
		'url',
		'validate',
		'area',
		'level',
	),
)); ?>
