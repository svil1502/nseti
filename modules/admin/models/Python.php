<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "python".
 *
 * @property int $id
 * @property string $title Название
 * @property string $description Описание
 * @property string $type Тип
 * @property string $params Параметры
 * @property int $created_at Дата добавление
 * @property int $updated_at
 */
class Python extends \yii\db\ActiveRecord
{
    public $image;
    public $tags_array;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'python';
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
            [['description'], 'required'],
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
    public function getPythonTag(){
        return $this->hasMany(PythonTag::className(),['chat_id'=>'id']);
    }

    public function getPtags()
    {
        return $this->hasMany(Ptag::className(), ['id' => 'tag_id'])->via('pythonTag');
    }

    public function getTagsAsString()
    {
        $arr = \yii\helpers\ArrayHelper::map($this->ptags,'id','name');
        return implode(', ',$arr);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->tags_array = $this->ptags;
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $arr = \yii\helpers\ArrayHelper::map($this->ptags,'id','id');
        foreach ($this->tags_array as $one){
            if(!in_array($one,$arr)){
                $model = new PythonTag();
                $model->chat_id = $this->id;
                $model->tag_id = $one;
                $model->save();
            }
            if(isset($arr[$one])){
                unset($arr[$one]);
            }
        }
        PythonTag::deleteAll(['tag_id'=>$arr]);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {

            PythonTag::deleteAll(['chat_id'=>$this->id]);
            return true;
        } else {
            return false;
        }
    }


}
