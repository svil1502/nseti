<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nseti_tag".
 *
 * @property int $id
 * @property int $chat_id
 * @property int $tag_id
 */
class NsetiTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nseti_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'tag_id'], 'required'],
            [['chat_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'tag_id' => 'Tag ID',
        ];
    }
    public function getNtag(){
        return $this->hasOne(Ntag::className(),['id'=>'tag_id']);
    }

}
