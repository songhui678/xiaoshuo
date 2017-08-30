<?php

/**
 * This is the model class for table "{{weixin_cate_relation}}".
 *
 * The followings are the available columns in table '{{weixin_cate_relation}}':
 * @property integer $id
 * @property integer $father_id
 * @property integer $cate_id
 * @property integer $article_id
 * @property string $add_time
 * @property string $published_time
 * @property integer $tuijian
 * @property integer $type
 * @property integer $validate
 */
class WeixinCateRelation extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{weixin_cate_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('father_id, cate_id, article_id, tuijian, type, validate', 'numerical', 'integerOnly' => true),
            array('add_time, published_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, father_id, cate_id, article_id, add_time, published_time, tuijian, type, validate', 'safe', 'on' => 'search'),
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
            'CateOne'   => array(self::BELONGS_TO, 'Cate', 'cate_id', 'condition' => 'validate = 0'),
            'WeixinOne' => array(self::BELONGS_TO, 'Weixin', 'weixin_id', 'condition' => 'validate = 0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'             => 'ID',
            'father_id'      => 'Father',
            'cate_id'        => 'Cate',
            'article_id'     => 'Article',
            'add_time'       => 'Add Time',
            'published_time' => 'Published Time',
            'tuijian'        => 'Tuijian',
            'type'           => 'Type',
            'validate'       => 'Validate',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('father_id', $this->father_id);
        $criteria->compare('cate_id', $this->cate_id);
        $criteria->compare('article_id', $this->article_id);
        $criteria->compare('add_time', $this->add_time, true);
        $criteria->compare('published_time', $this->published_time, true);
        $criteria->compare('tuijian', $this->tuijian);
        $criteria->compare('type', $this->type);
        $criteria->compare('validate', $this->validate);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return WeixinCateRelation the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
