<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LinksArticlesRelations;

/**
 * LinksArticlesRelationsSearch represents the model behind the search form of `app\models\LinksArticlesRelations`.
 */
class LinksArticlesRelationsSearch extends LinksArticlesRelations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'link_id', 'article_id'], 'integer'],
            [['intro', 'title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LinksArticlesRelations::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'link_id' => $this->link_id,
            'article_id' => $this->article_id,
        ]);

        $query->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
