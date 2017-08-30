<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带*号的为必填项</p>

	<?php echo $form->errorSummary($article); ?>

	<div class="row">
		<?php echo $form->labelEx($article,'title'); ?>
		<?php echo $form->textField($article,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($article,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($article,'summary'); ?>
		<?php echo $form->textField($article,'summary',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($article,'summary'); ?>
		<input type="hidden" name="article_id" id='article_id' value="<?php echo $article->id;?>" />
	</div>

    <div class="row">
		<table class="detail-view" id="yw0" >
		<tr class="odd" style="background:#4AB7EF;"><td>分类选择</td></tr>
 

		<?php foreach($cateList as $key=>$cate) { ?>
			<tr <?php if($key%2==0){ ?> class="even" <?php }else{ ?> class="odd" style="background:#D6ECF5" <?php } ?>>
			    <th style="text-align: left;"  ><?php echo $cate->title?></th>
			</tr>
			<tr>
				<?php $subList = Cate::model()->findAll(array('condition'=>'validate=0 and father_id ='.$cate->id));?>
				<?php foreach ($subList as $subcate) {?>
		    		<th style="text-align: left; width:30px; "  ><input type='checkbox' name='cate_id' value='<?php echo $subcate->id;?>'     /></th>
		    		<th style="text-align: left;width:40px;"><?php echo $subcate->title;?></th>
			    <?php }?>
			</tr>
		<?php }?>
 
		</table>
	</div>
    <div class="row">
        <?php echo $form->labelEx($cate,'tuijian'); ?>
        <?php echo $form->dropDownList($cate,'tuijian',array('0'=>'不推荐','1'=>'推荐')); ?> 
    </div>
 
    <div class="row buttons">
        <input name="tijiao" id="tijiao"  type="button" value="提交快递" />
    </div>
 

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$("#tijiao").click(
  function(){
    var data=new Array();
    $("input:checkbox[name='cate_id']").each(function (){
        if($(this).attr("checked")=="checked"){
            data.push($(this).val());
        }
    });
    var tuijian=$("#Cate_tuijian option:selected").text();
    var article_id=$("#article_id").val();
  
      $.ajax({
        type: "POST",
        url: "/srbac/article/catecreate",
        data: {"tuijian":tuijian,"cate_id":data,"article_id":article_id},
           success: function(msg){
            alert("保存成功"); 
            window.location.href = "/srbac/article/admin"; 
        }
      }); 
    
  }
);


 
 
</script>