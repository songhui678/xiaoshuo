<?php

/**
 * This is the model class for table "{{author}}".
 *
 * The followings are the available columns in table '{{author}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $ip
 * @property string $add_time
 * @property string $update_time
 * @property string $last_time
 * @property integer $score
 * @property string $name
 * @property string $sex
 * @property integer $province
 * @property integer $city
 * @property string $logo
 * @property string $sign
 * @property string $source
 * @property string $mobile
 * @property string $phone
 * @property string $qq
 * @property string $url
 * @property integer $validate
 * @property integer $area
 * @property integer $level
 */
class Author extends CActiveRecord
{

	public $_modelName = '表名称(新建模型需要在模型里面修改)';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Author the static model class
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
		return '{{author}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, ip, add_time, last_time, validate', 'required'),
			array('score, province, city, validate, area, level', 'numerical', 'integerOnly'=>true),
			array('username, password, email, ip, name, sex, logo, source, mobile, phone, qq, url', 'length', 'max'=>255),
			array('update_time, sign', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, ip, add_time, update_time, last_time, score, name, sex, province, city, logo, sign, source, mobile, phone, qq, url, validate, area, level', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'ip' => 'Ip',
			'add_time' => 'Add Time',
			'update_time' => 'Update Time',
			'last_time' => 'Last Time',
			'score' => 'Score',
			'name' => 'Name',
			'sex' => 'Sex',
			'province' => 'Province',
			'city' => 'City',
			'logo' => 'Logo',
			'sign' => 'Sign',
			'source' => 'Source',
			'mobile' => 'Mobile',
			'phone' => 'Phone',
			'qq' => 'Qq',
			'url' => 'Url',
			'validate' => 'Validate',
			'area' => 'Area',
			'level' => 'Level',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('last_time',$this->last_time,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('sign',$this->sign,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('validate',$this->validate);
		$criteria->compare('area',$this->area);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}