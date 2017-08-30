<?php

/**
 * This is the model class for table "{{article_reply}}".
 *
 * The followings are the available columns in table '{{article_reply}}':
 * @property integer $id
 * @property string $content
 * @property integer $uid
 * @property string $add_time
 * @property integer $article_id
 * @property integer $validate
 */
class ArticleReply extends CActiveRecord
{

	public $_modelName = '表名称(新建模型需要在模型里面修改)';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleReply the static model class
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
		return '{{article_reply}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, uid, article_id, validate', 'numerical', 'integerOnly'=>true),
			array('content, add_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, uid, add_time, article_id, validate', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Content',
			'uid' => 'Uid',
			'add_time' => 'Add Time',
			'article_id' => 'Article',
			'validate' => 'Validate',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('validate',$this->validate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}