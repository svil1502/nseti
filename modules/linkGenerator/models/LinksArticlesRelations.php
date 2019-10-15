<?php

namespace app\modules\linkGenerator\models;

//use app\modules\linkGenerator\models\Articles;
use app\models\Articles;
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


/**
 * This is the model class for table "mailing_list_entry".
 *
 * @property int $id
 * @property int $mailing_list_id
 * @property int $article_id
 * @property string $lead
 *
 * @property Article $article
 * @property MailingList $mailingList
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
            [['intro', 'link_id', 'article_id' ], 'required'],
            [['intro'], 'string'],
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
    public function getArticles()
    {
        return $this->hasOne(Articles::class, ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkGenerator()
    {
        return $this->hasOne(LinkGenerator::class, ['id' => 'link_id']);
    }
}
