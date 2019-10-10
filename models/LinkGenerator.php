<?php

namespace app\models;

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
            [['status', 'created_at', 'updated_at', 'user_sent', 'user_created'], 'integer'],
            [['send_at'], 'safe'],
            [['created_at', 'updated_at', 'user_sent', 'user_created'], 'required'],
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
            'send_at' => 'Отправлено',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_sent' => 'User Sent',
            'user_created' => 'User Created',
        ];
    }
}
