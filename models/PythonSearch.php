<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chat;

/**
 * ChatSearch represents the model behind the search form of `app\models\Chat`.
 */
class PythonSearch extends Python
{
    public $tagsAsString;
    public $date_from;
    public $date_to;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_from', 'date_to'], 'date', 'format' => 'dd.mm.yyyy'],
            [['title', 'description', 'question', 'type', 'params'], 'safe'],
            [['tagsAsString'], 'safe'],
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
        $query = Python::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'params',
                'description',
                'question',
                'type',
                //   'files.tag',
                //  'files.created_at',


                'tagsAsString' => [
                    'asc' => ['tag.name' => SORT_ASC],
                    'desc' => ['tag.name' => SORT_DESC],
                    'label' => 'Тэги'
                ],
                'created_at' => [
                    'asc' => ['python.created_at' => SORT_ASC],
                    'desc' => ['python.created_at' => SORT_DESC],
                    'label' => 'Дата'
                ],
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['tags']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'python.id' => $this->id,

        ]);
        $query->andFilterWhere(['like', 'python.title', $this->title])
            ->andFilterWhere(['like', 'python.created_at', $this->created_at])
            ->andFilterWhere(['like', 'python.description', $this->description])
            ->andFilterWhere(['like', 'python.question', $this->description])
            ->andFilterWhere(['like', 'python.type', $this->type])
            //  ->andFilterWhere(['like', 'files.file', $this->file])
            ->andFilterWhere(['like', 'python.params', $this->params])

            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from.' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to.' 23:59:59') : null]);


        $query->joinWith(['tags' => function ($q) {
            $q->where('tag.name LIKE "%' . $this->tagsAsString . '%"');
        }]);

        return $dataProvider;
    }
}
