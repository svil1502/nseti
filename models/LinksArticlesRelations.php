<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "links_articles_relations".
 *
 * @property int $id
 * @property int $link_id
 * @property int $article_id
 * @property string $intro
 * @property string $title
 */
class LinksArticlesRelations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'links_articles_relations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_id', 'article_id'], 'integer'],
            [['intro', 'title'], 'required'],
            [['intro', 'title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_id' => 'Link ID',
            'article_id' => 'Article ID',
            'intro' => 'Intro',
            'title' => 'Title',
        ];
    }
}
