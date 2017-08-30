<?php

/**
 * This is the model class for table "xu_customer".
 *
 * The followings are the available columns in table 'xu_customer':
 * @property integer $id
 * @property string $buyState
 * @property string $channel
 * @property string $channelName
 * @property string $createTime
 * @property integer $createUserId
 * @property string $customerKind
 * @property string $customerKindName
 * @property string $entryperson
 * @property string $qq
 * @property string $qqGroupName
 * @property string $qqGroupNum
 * @property string $qqNickname
 * @property string $update_
 * @property integer $userId
 * @property string $userName
 * @property string $userSort
 * @property integer $type
 */
class XuCustomer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'xu_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createUserId, userId, type', 'numerical', 'integerOnly'=>true),
			array('buyState, channel, channelName, createTime, customerKind, customerKindName, entryperson, qq, visitContent,qqGroupName, qqGroupNum, qqNickname, userName, userSort', 'length', 'max'=>500),
			array('update_', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, buyState, channel, channelName, createTime, createUserId, customerKind, customerKindName, entryperson, qq, qqGroupName, qqGroupNum, qqNickname, update_, userId, userName, userSort, type', 'safe', 'on'=>'search'),
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
			'buyState' => 'Buy State',
			'channel' => 'Channel',
			'channelName' => 'Channel Name',
			'createTime' => 'Create Time',
			'createUserId' => 'Create User',
			'customerKind' => 'Customer Kind',
			'customerKindName' => 'Customer Kind Name',
			'entryperson' => 'Entryperson',
			'qq' => 'Qq',
			'qqGroupName' => 'Qq Group Name',
			'qqGroupNum' => 'Qq Group Num',
			'qqNickname' => 'Qq Nickname',
			'update_' => 'Update',
			'userId' => 'User',
			'userName' => 'User Name',
			'userSort' => 'User Sort',
			'visitContent'=>'visitContent',
			'type' => 'Type',
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
		$criteria->compare('buyState',$this->buyState,true);
		$criteria->compare('channel',$this->channel,true);
		$criteria->compare('channelName',$this->channelName,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('createUserId',$this->createUserId);
		$criteria->compare('customerKind',$this->customerKind,true);
		$criteria->compare('customerKindName',$this->customerKindName,true);
		$criteria->compare('entryperson',$this->entryperson,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('qqGroupName',$this->qqGroupName,true);
		$criteria->compare('qqGroupNum',$this->qqGroupNum,true);
		$criteria->compare('qqNickname',$this->qqNickname,true);
		$criteria->compare('update_',$this->update_,true);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('userName',$this->userName,true);
		$criteria->compare('userSort',$this->userSort,true);
		$criteria->compare('visitContent',$this->visitContent,true);
		
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return XuCustomer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
