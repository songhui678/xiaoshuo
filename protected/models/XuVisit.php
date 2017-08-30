<?php

/**
 * This is the model class for table "xu_visit".
 *
 * The followings are the available columns in table 'xu_visit':
 * @property integer $id
 * @property integer $createUser
 * @property integer $customerId
 * @property string $customerKind
 * @property string $note
 * @property string $qq
 * @property integer $staffId
 * @property string $updateTimeF
 * @property string $channelName
 * @property string $customerName
 * @property string $phone
 * @property string $qqNickname
 * @property string $staffName
 */
class XuVisit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'xu_visit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createUser, customerId, staffId', 'numerical', 'integerOnly'=>true),
			array('customerKind, note, qq, channelName, customerName, phone, qqNickname, staffName', 'length', 'max'=>255),
			array('updateTimeF', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, createUser, customerId, customerKind, note, qq, staffId, updateTimeF, channelName, customerName, phone, qqNickname, staffName', 'safe', 'on'=>'search'),
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
			'createUser' => 'Create User',
			'customerId' => 'Customer',
			'customerKind' => 'Customer Kind',
			'note' => 'Note',
			'qq' => 'Qq',
			'staffId' => 'Staff',
			'updateTimeF' => 'Update Time F',
			'channelName' => 'Channel Name',
			'customerName' => 'Customer Name',
			'phone' => 'Phone',
			'qqNickname' => 'Qq Nickname',
			'staffName' => 'Staff Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('createUser',$this->createUser);
		$criteria->compare('customerId',$this->customerId);
		$criteria->compare('customerKind',$this->customerKind,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('staffId',$this->staffId);
		$criteria->compare('updateTimeF',$this->updateTimeF,true);
		$criteria->compare('channelName',$this->channelName,true);
		$criteria->compare('customerName',$this->customerName,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qqNickname',$this->qqNickname,true);
		$criteria->compare('staffName',$this->staffName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return XuVisit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
