<?php

/**
 * This is the model class for table "{{weixin}}".
 *
 * The followings are the available columns in table '{{weixin}}':
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $video_time
 * @property string $image_url
 * @property integer $author_id
 * @property string $video
 * @property integer $type
 * @property integer $tag_id
 * @property string $published_time
 * @property string $add_time
 * @property string $update_time
 * @property integer $click_total
 * @property integer $reply_total
 * @property integer $cate_id
 * @property integer $validate
 * @property integer $tuijian
 */
class Weixin extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{weixin}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('author_id, type, tag_id, click_total, reply_total, cate_id, validate, tuijian', 'numerical', 'integerOnly' => true),
            array('title, summary, image_url, video', 'length', 'max' => 255),
            array('video_time', 'length', 'max' => 50),
            array('content, published_time, add_time, update_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, summary, content, video_time, image_url, author_id, video, type, tag_id, published_time, add_time, update_time, click_total, reply_total, cate_id, validate, tuijian', 'safe', 'on' => 'search'),
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
            'CateOne' => array(self::BELONGS_TO, 'Cate', 'cate_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'             => 'ID',
            'title'          => 'Title',
            'summary'        => 'Summary',
            'content'        => 'Content',
            'video_time'     => 'Video Time',
            'image_url'      => 'Image Url',
            'author_id'      => 'Author',
            'video'          => 'Video',
            'type'           => 'Type',
            'tag_id'         => 'Tag',
            'published_time' => 'Published Time',
            'add_time'       => 'Add Time',
            'update_time'    => 'Update Time',
            'click_total'    => 'Click Total',
            'reply_total'    => 'Reply Total',
            'cate_id'        => 'Cate',
            'validate'       => 'Validate',
            'tuijian'        => 'Tuijian',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('video_time', $this->video_time, true);
        $criteria->compare('image_url', $this->image_url, true);
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
        $criteria->compare('tuijian', $this->tuijian);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Weixin the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
