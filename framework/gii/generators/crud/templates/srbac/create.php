<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->modelName;
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'创建',
);\n";
?>

$this->menu=array(
	array('label'=>'<?php echo $this->modelName; ?>列表', 'url'=>array('index')),
	array('label'=>'管理<?php echo $this->modelName; ?>', 'url'=>array('admin')),
);
?>

<h1>创建<?php echo $this->modelName; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
