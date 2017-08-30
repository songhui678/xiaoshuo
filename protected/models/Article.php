<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $video_time
 * @property integer $author_id
 * @property string $video
 * @property integer $type
 * @property integer $tag_id
 * @property string $add_time
 * @property string $update_time
 * @property integer $click_total
 * @property integer $reply_total
 * @property integer $cate_id
 * @property integer $validate
 */
class Article extends CActiveRecord
{

    public $_modelName = '视频';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Article the static model class
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
        return '{{article}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('author_id, type, tag_id, click_total, reply_total, cate_id, validate', 'numerical', 'integerOnly' => true),
            array('title, summary, video,', 'length', 'max' => 255),

            array('video_time', 'length', 'max' => 50),

            array('content,image_url', 'safe'),

            array('image_url',
                'file',
                'allowEmpty' => true,
                'types'      => 'jpg,gif,png,jpeg',
                'maxSize'    => 1024 * 1024 * 10,
                'tooLarge'   => '图片最大不超过10MB，请重新上传!',
            ),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, summary, content,image_url, video_time, author_id, video, type, tag_id, published_time, add_time, update_time, click_total, reply_total, cate_id, validate', 'safe', 'on' => 'search'),
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
            'CateOne'          => array(self::BELONGS_TO, 'Cate', 'cate_id'),
            'ArticleAuthorOne' => array(self::BELONGS_TO, 'ArticleAuthor', 'author_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'             => 'ID',
            'title'          => '标题',
            'summary'        => '简介',
            'content'        => '内容',
            'video_time'     => '播放时长',
            'author_id'      => '所属作者',
            'video'          => '视频链接',
            'type'           => '文章类型', //0=视频，1文章
            'tag_id'         => '标签ID',
            'published_time' => '视频发布时间',
            'add_time'       => '创建时间',
            'update_time'    => '更新时间',
            'click_total'    => '点击次数',
            'reply_total'    => '回复次数',
            'cate_id'        => '文章分类',
            'validate'       => '是否删除',
            'tuijian'        => '推荐',
            'image_url'      => '图片地址',
        );
    }

    // 获取父类列表
    public function getCateArr()
    {
        $cateList = Cate::model()->findAll(array('condition' => 'father_id = 0 and validate=0'));
        $cate     = array();
        if (!empty($cateList)) {
            foreach ($cateList as $key => $value) {
                $cate[$value->id] = $value->title;
            }
        }
        return $cate;
    }

    // 获取父类名称
    public function getCatename()
    {
        $cate = Cate::model()->find('id = ' . $this->cate_id);
        return $cate->name;
    }

    //客户类型
    public function getTypeName()
    {
        return $this->TypeArr[$this->type];
    }
    //客户类型
    public function getTypeArr()
    {
        $res = array(
            0 => '视频',
            1 => '文章',
        );
        return $res;
    }
    //客户类型
    public function getTuijianName()
    {
        return $this->TuijianArr[$this->tuijian];
    }
    //客户类型
    public function getTuijianArr()
    {
        $res = array(
            1 => '推荐',
            0 => '不推荐',
        );
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('video_time', $this->video_time, true);
        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('video', $this->video, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('tag_id', $this->tag_id);
        $criteria->compare('published_time', $this->published_time, true);
        $criteria->compare('add_time', $this->add_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('click_total', $this->click_total);
        $criteria->compare('reply_total', $this->reply_total);
        $criteria->compare('cate_id', $this->cate_id);
        $criteria->compare('validate', $this->validate);
        $criteria->compare('image_url', $this->image_url);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
