<?php
/**
 * The default srbac controller
 */
class DefaultController extends CController {
  
  private $user;
  /**
   * The default action if no route is specified
   */
  public function init(){
 
    parent::init();

    $this->user = Yii::app()->controller->module->getComponent('user');

  }

	public function actionIndex() {

    if($this->user->isGuest){

      $this->redirect(array('/srbac/default/shouye'));
    }else{

      $this->redirect(array('/srbac/default/shouye'));
    }
	}

  public function actionLogin(){

    // $this->layout = 'admin';
    $model=Yii::createComponent('application.modules.srbac.models.LoginForm');
    
    if(isset($_POST['LoginForm']))
    {
      $model->attributes=$_POST['LoginForm'];
 
      if($model->validate() && $model->login()){
        $this->redirect(Yii::app()->createUrl('/srbac/default/shouye'));
      }
    }
    // display the login form
    $this->renderPartial('login',array('model'=>$model));
  }

  public function actionLogout()
  {

    Yii::app()->controller->module->getComponent('user')->logout();
    $this->redirect(Yii::app()->createUrl('/srbac/default/login'));
  }

  public function actionShouye(){
    if($this->user->isGuest){
      $this->redirect(array('/srbac/default/login'));
    }else{
      $site_id =Yii::app()->controller->module->getComponent('user')->site_id;
      $id =Yii::app()->controller->module->getComponent('user')->__id;
      $admin = Admins::model()->find(array('condition'=>'userid='.$id));
      
      $zongjian = '';

      if($admin->userid!=$admin->site_id){
          $zongjian = Admins::model()->find(array('condition'=>'userid='.$admin->site_id));
      }

      $this->render('shouye',array('admin'=>$admin,'zongjian'=>$zongjian));
    }
  }

 }