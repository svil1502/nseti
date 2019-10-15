<?php

namespace app\models;

use app\modules\linkGenerator\models\LinksArticlesRelations;
use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $intro
 * @property string $content
 * @property int $category_id
 */
class Articles extends \yii\db\ActiveRecord
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
            [['intro', 'content'], 'string'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'intro' => 'Intro',
            'content' => 'Content',
            'category_id' => 'Category ID',
        ];
    }

    public function getLinksArticlesRelations()
    {
        return $this->hasMany(LinksArticlesRelations::class, ['article_id' => 'id']);
    }
}
