<?php

/**
 * This is the model class for table "rbac_admins".
 *
 * The followings are the available columns in table 'rbac_admins':
 * @property string $userid
 * @property string $username
 * @property string $password
 * @property integer $validate
 * @property string $createtime
 */
class Admins extends CActiveRecord
{
	public $_modelName = '后台用户';
	public $passwordrepeat;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admins the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return Yii::app()->params['tablePrefix'].'admins';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('validate', 'numerical', 'integerOnly'=>true),
			array('username', 'required','message'=>'请填写用户名！'),
			array('realname', 'required','message'=>'真实姓名不能为空！'),
			array('password', 'required','message'=>'密码不能为空！','on'=>'insert'),
			array('dep_id', 'required','message'=>'部门不能为空！'),
			
			array('password','compare','compareAttribute'=>'passwordrepeat','message'=>'两次密码输入不一致','on'=>'userinfo'),
			array('passwordrepeat','compare','compareAttribute'=>'password','message'=>'两次密码输入不一致','on'=>'userinfo'),
			array('email', 'required','message'=>'邮箱不能为空！'),
			array('username', 'unique', 'message'=>'用户名已存在！'),
			array('createtime,remark,ip,dep_id,realname,post,phone,area,sex,site_id,cate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid,remark, username, password, validate, createtime,cate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ProvinceOne'=>array(self::BELONGS_TO, 'Province', 'area'),
			'DepOne'=>array(self::BELONGS_TO, 'Department', 'dep_id'),
			'DepManyCont'=>array(self::STAT, 'Department', 'site_id'),
			'ClientManyCont'=>array(self::STAT, 'Client', 'uid'),
			'AdminsManyCont'=>array(self::STAT, 'Admins', 'site_id'),
			'ClientSiteManyCont'=>array(self::STAT, 'Client', 'site_id'),
			'AdminsDepManyCont'=>array(self::STAT, 'Admins', 'dep_id'),
			'SourceManyCont'=>array(self::STAT, 'Sources', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'username' => '用户名',
			'password' => '密码',
			'validate' => '状态',
			'ip' => '登录IP',
			'createtime' => '创建时间',
			'realname' => '真实姓名',
			'post' => '职位',
			'area' => '地区',
			'sex' => '性别',
			'phone' => '联系电话',
			'email' => '邮箱',
			'site_id' => '站点Id',
            'cate' => '类别',
            'dep_id' => '部门',
            'remark' => '备注',
            'passwordrepeat' => '重复密码',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{


		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('userid',$this->userid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('validate',$this->validate);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cate',$this->cate);
        $criteria->compare('site_id',$this->site_id);
        $criteria->compare('dep_id',$this->dep_id);
        $criteria->compare('remark',$this->remark);
        $criteria->order = 'validate asc,userid desc';
      
		//$criteria->compare('pid',$this->userid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
	}


	// 获取状态列表
	public function getStatusList(){
		return array(
			1=>'有效',
			2=>'无效',
			);
	}

	// 获取状态列表
	public function getColorStatusList(){
		return array(
			1=>'有效',
			2=>'<span style="color:red">无效</span>',
			);
	}
	public function getColorStatusName(){
		return $this->ColorStatusList[$this->validate];
	}
	// 获取状态列表
	public function getPostList(){
		$id = Yii::app()->controller->module->getComponent('user')->site_id;
		$post = Yii::app()->controller->module->getComponent('user')->post;
		$status=Yii::app()->controller->getAction()->getId();

		if($id!=1){
			if($status!='admin'){
				if($post==1){
					return array(
						4=>'总监',
						2=>'部门经理',
						3=>'员工',
					);	
				}elseif($post==4){
					return array(
						2=>'部门经理',
						3=>'员工',
					
					);	
				}elseif($post==2){
					return array(

						3=>'员工',
					);	
				}
			}else{
				return array(
					1=>'系统管理',
					4=>'总监',
					2=>'部门经理',
					3=>'员工',
				);
			}
		}else{

			if($status=='update'){
				return array(
					1=>'系统管理',
					
				);
			}else{
				return array(
					1=>'系统管理',
					// 4=>'总监',
					// 2=>'部门经理',
					// 3=>'员工',
					
				);
			}
		}
	}

	// 获取状态列表
	public function getSexList(){
		return array(
			1=>'男',
			2=>'女',
			);
	}
	public function getPostNameList(){
		$arr= array(
			1=>'系统管理',
			4=>'总监',
			2=>'部门经理',
			3=>'员工',
			
		);
		return $arr[$this->post];

	}

	public function getDepList(){
		$id = Yii::app()->controller->module->getComponent('user')->site_id;
		$dep_id = Yii::app()->controller->module->getComponent('user')->dep_id;
		$post = Yii::app()->controller->module->getComponent('user')->post;
		if($id==1){
			$res=Department::model()->findAll(array('condition'=>'validate=1'));
		}else{
			if($post==1){
				$res=Department::model()->findAll(array('condition'=>'validate=1  and site_id='.$id));
			}elseif($post==4){
 				$res=Department::model()->findAll(array('condition'=>'validate=1  and site_id='.$id));
			}elseif($post==2){
 				$res=Department::model()->findAll(array('condition'=>'validate=1 and id='.$dep_id.' and site_id='.$id));
			}

		}

		foreach ($res as $key => $value) {
			$show[$value->id]=$value->name;
		}
		return $show;
	}
	public function getDepName(){
		return $this->depList[$this->dep_id];
	}


	public function getStatusName(){
		return $this->statusList[$this->validate];
	}

	public function getPostName(){
		return $this->postList[$this->post];
	}

	public function getSexName(){
		return $this->sexList[$this->sex];
	}
	// public function defaultScope()
	// {
	// 	$name = Yii::app()->controller->id;//控制器名
	// 	$status=Yii::app()->controller->getAction()->getId();//方法名
	// 	if($status!='login'){
	// 		$id = Yii::app()->controller->module->getComponent('user')->site_id;
	// 		$post = Yii::app()->controller->module->getComponent('user')->post;
 
	// 		if($id!=1 ){
	// 			if($name=='kehu'){

				
	// 				if($status!='lianxi' && $status!='setChangeuid'){
	// 					if($post==1){
	// 						return array(
	// 							'condition'=>"site_id=$id",
	// 						);		
	// 					}elseif($post==4){
	// 						return array(
	// 							'condition'=>"site_id=$id",
	// 						);	
	// 					}elseif($post==2){
	// 						return array(
	// 								'condition'=>"site_id=$id ",
	// 						);
 
								
	// 					}elseif($post==3){
	// 							return array(
	// 							'condition'=>"site_id=$id  and post=3 and dep_id=$dep_id",
	// 						);	
	// 					}
	// 				}
	// 			}else if($name=='bmtj'){
	// 		    }else if($name=='tongji'){
	// 			}else if($name=='import'){
	// 			}else if($status=='shouye'){
	// 			}else if($name=='gerenziliao'){
	// 			}else if($name=='zykhgl'){	
	// 			}else{
	// 				if($status!='create'){
	// 					if($post==1){
	// 						return array(
	// 							'condition'=>"site_id=$id  and post!=1",
	// 						);		
	// 					}elseif($post==4){
	// 							return array(
	// 							'condition'=>"site_id=$id  and post!=1 and post!=4",
	// 						);	
	// 					}elseif($post==2){
	// 							return array(
	// 							'condition'=>"site_id=$id  and post!=1 and post!=2 and post!=4 and dep_id=$dep_id",
	// 						);	
	// 					}elseif($post==3){
	// 							return array(
	// 							'condition'=>"site_id=$id  and post!=1 and post!=2 and dep_id=$dep_id",
	// 						);	
	// 					}
	// 				}
	// 			}

	// 		}
	// 	}

	// }

	// public function defaultScope()
	// {
	// 	$id=Yii::app()->session['site_id'];
	// 	$status=Yii::app()->controller->getAction()->getId();
	// 	if($status=='login'){
	// 		return array(
		            
	// 	        );

		
	// 	}elseif($status=='create'){
	// 		return array(
		            
	// 	        );
			
	// 	}else{
	// 		if($id!=1){
	// 			return array(
	// 	            'condition'=>"userid=$id or pid=$id",
	// 	        );
	// 		}
	// 	}
	//  }
}