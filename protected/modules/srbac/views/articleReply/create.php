<?php
/* @var $this ArticleReplyController */
/* @var $model ArticleReply */

$this->breadcrumbs=array(
	'表名称(新建模型需要在模型里面修改)'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'表名称(新建模型需要在模型里面修改)列表', 'url'=>array('index')),
	array('label'=>'管理表名称(新建模型需要在模型里面修改)', 'url'=>array('admin')),
);
?>

<h1>创建表名称(新建模型需要在模型里面修改)</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>