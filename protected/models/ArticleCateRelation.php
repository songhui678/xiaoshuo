<?php

/**
 * This is the model class for table "{{article_cate_relation}}".
 *
 * The followings are the available columns in table '{{article_cate_relation}}':
 * @property integer $id
 * @property integer $cate_id
 * @property integer $article_id
 * @property string $add_time
 * @property integer $validate
 */
class ArticleCateRelation extends CActiveRecord
{

    public $_modelName = '表名称(新建模型需要在模型里面修改)';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ArticleCateRelation the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{article_cate_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cate_id, article_id, validate', 'numerical', 'integerOnly' => true),
            array('add_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, cate_id, article_id, add_time,published_time, validate', 'safe', 'on' => 'search'),
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
            'CateOne'    => array(self::BELONGS_TO, 'Cate', 'cate_id', 'condition' => 'validate = 0'),
            'ArticleOne' => array(self::BELONGS_TO, 'Article', 'article_id', 'condition' => 'validate = 0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'             => 'ID',
            'father_id'      => 'father_id',
            'cate_id'        => 'Cate',
            'article_id'     => 'Article',
            'add_time'       => 'Add Time',
            'published_time' => 'Published Time',
            'validate'       => 'Validate',
            'tuijian'        => 'tuijian',
        );
    }

    //文章分类
    public function getCatName()
    {
        $name = Cate::model()->find(array('condition' => 'validate = 0 and id=' . $this->cate_id));
        return $name->title;
    }
    //文章分类
    public function getCatArr()
    {
        $res  = array();
        $list = Cate::model()->findAll(array('select' => 'id,title', 'condition' => 'validate = 0 and father_id<>0', 'order' => 'sort asc'));
        $list = Helper::objToArr($list);

        foreach ($list as $value) {
            $res[$value['id']] = $value['title'];

        }
        return $res;
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('cate_id', $this->cate_id);
        $criteria->compare('article_id', $this->article_id);
        $criteria->compare('add_time', $this->add_time, true);
        $criteria->compare('published_time', $this->published_time, true);
        $criteria->compare('validate', $this->validate);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
