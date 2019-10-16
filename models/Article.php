<?php

namespace app\models;


use app\modules\mailList\models\LinksArticlesRelations;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $lead
 *
 * @property MailingListEntry[] $mailingListEntries
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title',
                //'lead',
                'intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            //'lead' => 'Lead',
            'intro' => 'intro',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinksArticlesRelationses()
    {
        return $this->hasMany(LinksArticlesRelations::class, ['article_id' => 'id']);
    }
}

