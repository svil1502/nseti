<?php

namespace app\modules\linkGenerator\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_generator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['status', 'created_at', 'updated_at', 'user_created', 'send_at'], 'integer'],
          //  [['send_at'], 'safe'],
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
