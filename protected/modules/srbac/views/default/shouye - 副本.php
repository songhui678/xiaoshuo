<div class="wxin">
  <p>
	<?php 
		if(Yii::app()->controller->module->getComponent('user')->post==1){
		
			if($admin->DepManyCont==0){?>
				在添加新用户之前，请 先添加 <a href="/srbac/bmgl/create"><font color="red">部门</font></a>  和 <a href="/srbac/lygl/create"><font color="red">客户来源</font></a>
			<?php }  else { ?>
				截止到现在[<?php echo date("Y-m-d H:i:s",time()); ?>]:
				您已经设置 <a href="/srbac/bmgl/admin"><font color="red"><?php echo $admin->DepManyCont; ?></font></a> 个部门，总计 <a href="/srbac/admins/admin"><font color="red"><?php echo $admin->AdminsManyCont(array('condition'=>'post!=1')); ?></font></a> 人。
				有 <a href="/srbac/lygl/admin"><font color="red"> <?php echo $admin->SourceManyCont;?></font></a> 条客户来源。
				总计 <a href="/srbac/kehu/admin"><font color="red"><?php echo $admin->ClientSiteManyCont?$admin->ClientSiteManyCont:0; ?> </font></a>个客户，
				其中有 <?php echo $admin->ClientSiteManyCont(array('condition'=>'status=1'))?$admin->ClientSiteManyCont(array('condition'=>'status=1')):0; ?>个有效客户，
				有<font color="red"><?php echo $admin->ClientSiteManyCont(array('condition'=>'remind_status!=0'))?$admin->ClientSiteManyCont(array('condition'=>'remind_status!=0')):0; ?> 条提醒</font>.
	    	<?php }  ?>
			<?php } else if(Yii::app()->controller->module->getComponent('user')->post==4){
		
			if($zongjian->DepManyCont==0){?>
				在添加新用户之前，请 先添加 <a href="/srbac/bmgl/create"><font color="red">部门</font></a>  和 <a href="/srbac/lygl/create"><font color="red">客户来源</font></a>
			<?php }  else { ?>
				截止到现在[<?php echo date("Y-m-d H:i:s",time()); ?>]:
				您已经设置 <a href="/srbac/bmgl/admin"><font color="red"><?php echo $zongjian->DepManyCont; ?></font></a> 个部门，总计 <a href="/srbac/admins/admin"><font color="red"><?php echo $zongjian->AdminsManyCont(array('condition'=>'post!=1')); ?></font></a> 人。
				有 <a href="/srbac/lygl/admin"><font color="red"> <?php echo $zongjian->SourceManyCont;?></font></a> 条客户来源。
				总计 <a href="/srbac/kehu/admin"><font color="red"><?php echo $zongjian->ClientSiteManyCont?$admin->ClientSiteManyCont:0; ?> </font></a>个客户，
				其中有 <?php echo $zongjian->ClientSiteManyCont(array('condition'=>'status=1'))?$zongjian->ClientSiteManyCont(array('condition'=>'status=1')):0; ?>个有效客户，
				有<font color="red"><?php echo $zongjian->ClientSiteManyCont(array('condition'=>'remind_status!=0'))?$zongjian->ClientSiteManyCont(array('condition'=>'remind_status!=0')):0; ?> 条提醒</font>.
	    	<?php }  ?>

		<?php } else if(Yii::app()->controller->module->getComponent('user')->post==2){?>

				截止到现在[<?php echo date("Y-m-d H:i:s",time()); ?>]:
				您部门共有 <a href="/srbac/admins/admin"><font color="red"><?php echo $admin->DepOne->AdminsManyCont;?></font></a> 人;
				总计 <a href="/srbac/kehu/admin"><font color="red"><?php echo $admin->DepOne->ClientManyCont;?> </font></a>个客户，
				其中有 <?php echo $admin->DepOne->ClientManyCont(array('condition'=>'status=1'));?> 个有效客户，
				有 <font color="red"><?php echo $admin->DepOne->ClientManyCont(array('condition'=>'remind_status!=0'));?> 条提醒</font>

		<?php } else if(Yii::app()->controller->module->getComponent('user')->post==3){?>

			截止到现在[<?php echo date("Y-m-d H:i:s",time()); ?>]:
			您可以联系 <a href="/srbac/kehu/admin"><font color="red"><?php echo $admin->ClientManyCont?$admin->ClientManyCont:0; ?></font></a> 个客户，
			其中有 <?php echo $admin->ClientManyCont(array('condition'=>'status=1'))?$admin->ClientManyCont(array('condition'=>'status=1')):0; ?>个有效客户，
			有 <font color="red"><?php echo $admin->ClientManyCont(array('condition'=>'remind_status!=0'))?$admin->ClientManyCont(array('condition'=>'remind_status!=0')):0; ?> 条提醒</font>
		<?php } ?>
	</p></div>