<?php

/**
 * This is the model class for table "{{links}}".
 *
 * The followings are the available columns in table '{{links}}':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $logo
 * @property integer $is_hidden
 */
class Links extends CActiveRecord
{

	public $_modelName = '表名称(新建模型需要在模型里面修改)';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Links the static model class
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
		return '{{links}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_hidden', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('url, logo', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, logo, is_hidden', 'safe', 'on'=>'search'),
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
			'name' => '链接名称',
			'url' => '链接地址',
			'logo' => '链接图',
			'is_hidden' => '是否隐藏',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('is_hidden',$this->is_hidden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}