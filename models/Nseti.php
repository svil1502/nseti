<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "nseti".
 *
 * @property int $id
 * @property string $title Название
 * @property string $description Описание
 * @property string $type Тип
 * @property string $params Параметры
 * @property int $created_at Дата добавление
 * @property int $updated_at
 */
class nseti extends \yii\db\ActiveRecord
{
    public $image;
    public $tags_array;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nseti';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['description', 'tags_array','params'], 'required'],
            [[ 'question', 'description'], 'string'],
            [['id'], 'integer'],
            [['tagsAsString'], 'safe'],
            [['created_at'], 'integer'],
            //  [['created_at', 'updated_at'], 'date','format' => 'dd.mm.yyyy'],
            //'format' => 'dd.mm.yyyy'
            [['title'], 'string', 'max' => 500],
            [['type', 'params'], 'string', 'max' => 255],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png, pdf'],
            [['image'], 'file', 'maxSize'=>'100000000'],
            [['title', 'params'], 'string', 'max' => 255],
            [['tags_array'], 'safe'],
        ];
    }
    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Источник',
            'question' => 'Вопрос',
            'description' => 'Ответ',
            'type' => 'Ссылки',
            // 'file' => 'File',
            'params' => 'Загружен как',
            'created_at' => 'Дата создания',
            'updated_at' => 'Date Update',
            'tagsAsString' => 'Тэги',
            'tags_array' => 'Тэги',
            'image' => 'Файл',

        ];
    }
    public function getChatTag(){
        return $this->hasMany(ChatTag::className(),['chat_id'=>'id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->via('chatTag');
    }

    public function getTagsAsString()
    {
        $arr = \yii\helpers\ArrayHelper::map($this->tags,'id','name');
        return implode(', ',$arr);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->tags_array = $this->tags;
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $arr = \yii\helpers\ArrayHelper::map($this->tags,'id','id');
        foreach ($this->tags_array as $one){
            if(!in_array($one,$arr)){
                $model = new NsetiTag();
                $model->nseti_id = $this->id;
                $model->tag_id = $one;
                $model->save();
            }
            if(isset($arr[$one])){
                unset($arr[$one]);
            }
        }
        NsetiTag::deleteAll(['tag_id'=>$arr]);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {

            NsetiTag::deleteAll(['nseti_id'=>$this->id]);
            return true;
        } else {
            return false;
        }
    }


}
