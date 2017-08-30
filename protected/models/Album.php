<?php

/**
 * This is the model class for table "{{album}}".
 *
 * The followings are the available columns in table '{{album}}':
 * @property integer $id
 * @property string $name
 * @property string $fengmian
 * @property integer $yuan_id
 * @property string $yuan_url
 * @property integer $validate
 * @property integer $click
 * @property string $add_time
 * @property integer $photo_count
 */
class Album extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{album}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('yuan_id, validate, click, photo_count', 'numerical', 'integerOnly' => true),
			array('name, fengmian', 'length', 'max' => 100),
			array('yuan_url', 'length', 'max' => 255),
			array('add_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, fengmian, yuan_id, yuan_url, validate, click, add_time, photo_count', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'fengmian' => 'Fengmian',
			'yuan_id' => 'Yuan',
			'yuan_url' => 'Yuan Url',
			'validate' => 'Validate',
			'click' => 'Click',
			'add_time' => 'Add Time',
			'photo_count' => 'Photo Count',
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
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('fengmian', $this->fengmian, true);
		$criteria->compare('yuan_id', $this->yuan_id);
		$criteria->compare('yuan_url', $this->yuan_url, true);
		$criteria->compare('validate', $this->validate);
		$criteria->compare('click', $this->click);
		$criteria->compare('add_time', $this->add_time, true);
		$criteria->compare('photo_count', $this->photo_count);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Album the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
}
