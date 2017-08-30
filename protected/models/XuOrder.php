<?php

/**
 * This is the model class for table "xu_order".
 *
 * The followings are the available columns in table 'xu_order':
 * @property integer $id
 * @property string $applyTime
 * @property string $buyNote
 * @property integer $buyNum
 * @property string $couponPrice
 * @property string $createTime
 * @property integer $createUser
 * @property string $endTime
 * @property integer $isEnable
 * @property string $originalPrice
 * @property integer $payState
 * @property string $payTime
 * @property string $price
 * @property integer $productId
 * @property string $productName
 * @property string $properties
 * @property string $qq
 * @property string $qqNickName
 * @property integer $teacherId
 * @property integer $trift
 * @property integer $type
 * @property string $updateTime
 * @property integer $updateUser
 * @property integer $useState
 * @property integer $userId
 * @property string $userName
 * @property integer $websiteId
 */
class XuOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'xu_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buyNum, createUser, isEnable, payState, productId, teacherId, trift, type, updateUser, useState, userId, websiteId', 'numerical', 'integerOnly'=>true),
			array('applyTime, endTime, payTime, updateTime', 'length', 'max'=>50),
			array('buyNote, productName, properties, qq, qqNickName, userName', 'length', 'max'=>255),
			array('couponPrice, originalPrice, price', 'length', 'max'=>10),
			array('createTime', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, applyTime, buyNote, buyNum, couponPrice, createTime, createUser, endTime, isEnable, originalPrice, payState, payTime, price, productId, productName, properties, qq, qqNickName, teacherId, trift, type, updateTime, updateUser, useState, userId, userName, websiteId', 'safe', 'on'=>'search'),
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
			'applyTime' => 'Apply Time',
			'buyNote' => 'Buy Note',
			'buyNum' => 'Buy Num',
			'couponPrice' => 'Coupon Price',
			'createTime' => 'Create Time',
			'createUser' => 'Create User',
			'endTime' => 'End Time',
			'isEnable' => 'Is Enable',
			'originalPrice' => 'Original Price',
			'payState' => 'Pay State',
			'payTime' => 'Pay Time',
			'price' => 'Price',
			'productId' => 'Product',
			'productName' => 'Product Name',
			'properties' => 'Properties',
			'qq' => 'Qq',
			'qqNickName' => 'Qq Nick Name',
			'teacherId' => 'Teacher',
			'trift' => 'Trift',
			'type' => 'Type',
			'updateTime' => 'Update Time',
			'updateUser' => 'Update User',
			'useState' => 'Use State',
			'userId' => 'User',
			'userName' => 'User Name',
			'websiteId' => 'Website',
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
		$criteria->compare('applyTime',$this->applyTime,true);
		$criteria->compare('buyNote',$this->buyNote,true);
		$criteria->compare('buyNum',$this->buyNum);
		$criteria->compare('couponPrice',$this->couponPrice,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('createUser',$this->createUser);
		$criteria->compare('endTime',$this->endTime,true);
		$criteria->compare('isEnable',$this->isEnable);
		$criteria->compare('originalPrice',$this->originalPrice,true);
		$criteria->compare('payState',$this->payState);
		$criteria->compare('payTime',$this->payTime,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('productId',$this->productId);
		$criteria->compare('productName',$this->productName,true);
		$criteria->compare('properties',$this->properties,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('qqNickName',$this->qqNickName,true);
		$criteria->compare('teacherId',$this->teacherId);
		$criteria->compare('trift',$this->trift);
		$criteria->compare('type',$this->type);
		$criteria->compare('updateTime',$this->updateTime,true);
		$criteria->compare('updateUser',$this->updateUser);
		$criteria->compare('useState',$this->useState);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('userName',$this->userName,true);
		$criteria->compare('websiteId',$this->websiteId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return XuOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
