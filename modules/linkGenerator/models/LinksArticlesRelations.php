<?php

namespace app\modules\linkGenerator\models;

use Yii;
use app\models\Article;
/**
 * This is the model class for table "links_articles_relations".
 *
 * @property int $id
 * @property int $link_id
 * @property int $article_id
 * @property string $intro
 *
 * @property Articles $article
 * @property LinksArticlesRelations $link
 * @property LinksArticlesRelations[] $linksArticlesRelations
 */
class LinksArticlesRelations extends \yii\db\ActiveRecord
{
    public $article_arr = [];
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
            [['link_id', 'article_id', 'intro'], 'required'],
            [['intro'], 'string'],
        //    [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::className(), 'targetAttribute' => ['article_id' => 'id']],
         //   [['link_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinksArticlesRelations::className(), 'targetAttribute' => ['link_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id'])->with(['articlesCategories']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkGenerator()
    {
        return $this->hasOne(LinkGenerator::className(), ['id' => 'link_id']);
    }


}
