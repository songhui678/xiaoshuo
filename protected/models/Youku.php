<?php

/**
 * This is the model class for table "{{youku}}".
 *
 * The followings are the available columns in table '{{youku}}':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $url_id
 * @property integer $daoru
 * @property integer $validate
 */
class Youku extends CActiveRecord
{

	public $_modelName = '表名称(新建模型需要在模型里面修改)';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Youku the static model class
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
		return '{{youku}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('daoru, validate', 'numerical', 'integerOnly'=>true),
			array('title, url, url_id,image', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, url, url_id, daoru,image, validate', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'url' => 'Url',
			'url_id' => 'Url',
			'daoru' => 'Daoru',
			'validate' => 'Validate',
			'image'=>'image',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('url_id',$this->url_id,true);
		$criteria->compare('daoru',$this->daoru);
		$criteria->compare('validate',$this->validate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}