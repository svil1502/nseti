<?php

namespace app\modules\linkGenerator\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "link_generator".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property string $send_at
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_sent
 * @property int $user_created
 */
class LinkGenerator extends \yii\db\ActiveRecord
{
    public $sendAtTime;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_generator';
    }

//    public function behaviors()
//    {
//        return [
//            TimestampBehavior::className(),
//        ];
//    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['status', 'user_created'], 'integer'],
            [['send_at', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Тема',
            'status' => 'Статус',
            'send_at' => 'Дата отправки',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'user_created' => 'User Created',
            'sendAtTime' => 'Время отправки',
        ];
    }
    /**
 * @return \yii\db\ActiveQuery
 */
    public function getLinksArticlesRelationses()
    {
        return $this->hasMany(LinksArticlesRelations::class, ['link_id' => 'id']);
    }

}
