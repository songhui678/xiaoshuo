<?php

/**
 * This is the model class for table "{{cate}}".
 *
 * The followings are the available columns in table '{{cate}}':
 * @property integer $id
 * @property integer $father_id
 * @property string $title
 * @property string $add_time
 * @property integer $validate
 * @property integer $sort
 */
class Cate extends CActiveRecord
{

    public $_modelName = '表名称(新建模型需要在模型里面修改)';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cate the static model class
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
        return '{{cate}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('father_id, validate, sort', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('add_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, father_id, title, add_time, validate, sort', 'safe', 'on' => 'search'),
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
            'CateRelation' => array(self::HAS_MANY, 'ArticleCateRelation', 'id'),
            'ArticleMany'  => array(self::HAS_MANY, 'Article', 'id', 'condition' => 'validate = 0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'        => 'ID',
            'father_id' => '父ID',
            'title'     => '分类标题',
            'add_time'  => '创建时间',
            'validate'  => 'Validate',
            'sort'      => '排序',
            'tuijian'   => '推荐',
            'pinyin'    => '拼音',
            'video_url' => '视频地址',
        );
    }
    // 获取父类列表
    public function getFuleiList()
    {
        if ($this->isNewRecord) {
            $fuleiList = $this->findAll(array('condition' => 'father_id = 0'));
        } else {
            if (!empty($this->id)) {
                $fuleiList = $this->findAll(array('condition' => 'father_id = 0 and id != ' . $this->id));
            }

        }
        $fulei    = array();
        $fulei[0] = '顶级分类';
        if (!empty($fuleiList)) {
            foreach ($fuleiList as $key => $value) {
                $fulei[$value->id] = $value->title;
            }
        }

        return $fulei;
    }

    // 获取父类名称
    public function getFuleiname()
    {
        if ($this->father_id == 0) {
            return '顶级分类';
        } else {
            $fulei = $this->find('id = ' . $this->father_id);
            return $fulei->name;
        }
    }

    // 获取子类列表
    public function getSubList()
    {
        $subList = $this->findAll(array('condition' => 'validate=0 and father_id =' . $this->id));
        $sublei  = array();
        if ($subList) {
            foreach ($subList as $key => $value) {
                $sublei[$value->id] = $value->title;
            }
        }
        return $sublei;
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
        $criteria->compare('father_id', $this->father_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('add_time', $this->add_time, true);
        $criteria->compare('validate', $this->validate);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('pinyin', $this->pinyin, true);
        $criteria->compare('video_url', $this->video_url, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
