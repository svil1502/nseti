<?php

namespace app\models;

use Yii;
use app\modules\mailList\models\LinksArticlesRelations;
/**
 * This is the model class for table "articles_categories".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $level
 * @property int $is_published
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property int $articles_count
 * @property int $position
 * @property int $realty_mail_ru_rubric_id Соотношение нашей категории к ID рубрики в недвижимость.mail.ru
 *
 * @property Articles[] $articles
 */
class ArticlesCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'is_published', 'articles_count', 'position', 'realty_mail_ru_rubric_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'slug', 'seo_title', 'seo_description', 'seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'level' => 'Level',
            'is_published' => 'Is Published',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
            'seo_keywords' => 'Seo Keywords',
            'articles_count' => 'Articles Count',
            'position' => 'Position',
            'realty_mail_ru_rubric_id' => 'Realty Mail Ru Rubric ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['category_id' => 'id'])->with(['linksArticlesRelationses']);
    }



}
