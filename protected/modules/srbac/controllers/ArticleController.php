<?php

class ArticleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='application.modules.srbac.views.layouts.admin';
	

	public $filePath;

  public function actions()
  {

    list($s1, $s2) = explode(' ', microtime());   
    $fileName = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000); 
    $fileName.=rand(0,9999);

    if(!empty($_GET['fileName'])){
      $fileName = $_GET['fileName'];
    }

    $path = $this->filePath[$_GET['filePath']];
    $after = $_GET['after'];
    $res = array(
      //上传图片
      'upload'=>array(
        'class'=>'application.extensions.swfupload.SWFUploadAction',
        'filepath'=>Yii::app()->basePath.'/../upload/'.$path.$fileName.'.EXT',
        //注意这里是绝对路径,.EXT是文件后缀名替代符号
      )
    );
    if(!empty($after)){
      $res['upload']['onAfterUpload'] = array($this,$after);
    }
    
    return $res;
  }
	public function init()
	{
    	 Yii::app()->clientScript->registerScriptFile('/static/houtai/js/jquery.form.js');
	     $this->filePath=array(
	      1=>'video_photo/'.date('Y-m-d').'/',//攻略pdf路径
	    );
	}
	// //处理logo图片
	// public function tuangoutu($event){
	//     //原图路径
	//     $src = Yii::app()->basePath.'/../upload/'.$this->filePath[1].$event->sender['name'];
	//     //生成缩略图
	//     $image = Yii::app()->image->load($src);

	//     $src100 = Yii::app()->basePath.'/../upload/'.$this->filePath[1].'small/'.$event->sender['name'];

	//     $image->smart_resize(120,92); //120px*45px
	//     $image->save($src100);

	//     return true;

	// }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Article;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{

		    list($s1, $s2) = explode(' ', microtime());   
		    $fileName = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000); 
		    $fileName.=rand(0,9999);
			$model->attributes=$_POST['Article'];
			$image = CUploadedFile::getInstance($model, 'image_url');
			// $image->reset;
			if( is_object($image) && get_class($image) === 'CUploadedFile' ){
				$model->image_url = $this->filePath[1].$fileName.'.'.$image->extensionName;
			}else{
				$model->image_url = 'NoPic.jpg';
			}

			if($model->save()){
				$filep=Yii::app()->basePath.'/../upload/'.$model->image_url;
				$filep = str_replace('\\','/',$filep);
				$filename = substr(strrchr($filep,'/'),1);
				$filedir = str_replace(array("/$filename"),'',$filep);
				if(!is_dir($filedir))
			    {
			        mkdir($filedir, 0777,true); 
			    }
				$image->saveAs($filep);
 
			}
			$this->redirect(array('cate','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{
		    list($s1, $s2) = explode(' ', microtime());   
		    $fileName = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000); 
		    $fileName.=rand(0,9999);
		    $image = CUploadedFile::getInstance($model, 'image_url');
			$model->attributes=$_POST['Article'];

			
			if( is_object($image) && get_class($image) === 'CUploadedFile' ){
				$model->image_url = $this->filePath[1].$fileName.'.'.$image->extensionName;
			}else{
				$model->image_url = 'NoPic.jpg';
			}
			if($model->save()){
				$filep=Yii::app()->basePath.'/../upload/'.$model->image_url;
				$filep = str_replace('\\','/',$filep);
				$filename = substr(strrchr($filep,'/'),1);
				$filedir = str_replace(array("/$filename"),'',$filep);
				if(!is_dir($filedir))
			    {
			        mkdir($filedir, 0777,true); 
			    }
				$image->saveAs($filep);
			}

			$this->redirect(array('cate','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCate($id)
	{
		$article=$this->loadModel($id);
 		$cateList=Cate::model()->findAll('father_id=0 and validate=0');
		if(isset($_POST['Cate']))
		{
			$model=new Cate();
			$model->attributes=$_POST['Cate'];


			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('cate',array(
			'article'=>$article,'cateList'=>$cateList,
			
		));
	}

	public function actionCatecreate()
	{

		$article_id=Yii::app()->request->getParam('article_id');
		$cate=Yii::app()->request->getParam('cate_id');
		$tuijian=Yii::app()->request->getParam('tuijian');

		$article=$this->loadModel($article_id);
		foreach ($cate as $key => $value) {
			$catearticle=ArticleCateRelation::model()->find("article_id=:article_id and cate_id=:cate_id",array(":article_id"=>$article_id,":cate_id"=>$value));

			if(empty($catearticle)){
				$cate =Cate::model()->find('id = '.$value);

				$caterelation= new ArticleCateRelation();
				$caterelation->article_id=$article_id;
				$caterelation->father_id=$cate->father_id;
				$caterelation->cate_id=$value;
				$caterelation->add_time= date("Y-m-d h:i:s",time());
				$caterelation->validate=0;
				$caterelation->tuijian=$tuijian;
				$caterelation->save(false);
			}

		}
 		$this->redirect(array('view','id'=>$article_id));

 
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Article');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Article('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Article']))
			$model->attributes=$_GET['Article'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	// 批量删除操作
	public function actionDelall(){
		$res = array();
		if(isset($_POST['selectdel'])){
			foreach ($_POST['selectdel'] as $key => $value) {
				$model = $this->loadModel($value);
				$model->delete();

				
			}
			$res['statu'] = 0;
			echo CJSON::encode($res);
		}else{
			$res['statu'] = 1;
			echo CJSON::encode($res);
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Article the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Article::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Article $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
