<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Nseti;

/**
 * NsetiSearch represents the model behind the search form of `app\models\Nseti`.
 */
class NsetiSearch extends Nseti
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
        $query = Nseti::find();

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
                    'asc' => ['ntag.name' => SORT_ASC],
                    'desc' => ['ntag.name' => SORT_DESC],
                    'label' => 'Тэги'
                ],
                'created_at' => [
                    'asc' => ['nseti.created_at' => SORT_ASC],
                    'desc' => ['nseti.created_at' => SORT_DESC],
                    'label' => 'Дата'
                ],
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['ntags']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'nseti.id' => $this->id,

        ]);
        $query->andFilterWhere(['like', 'nseti.title', $this->title])
            ->andFilterWhere(['like', 'nseti.created_at', $this->created_at])
            ->andFilterWhere(['like', 'nseti.description', $this->description])
            ->andFilterWhere(['like', 'nseti.question', $this->question])
            ->andFilterWhere(['like', 'nseti.type', $this->type])
            //  ->andFilterWhere(['like', 'files.file', $this->file])
            ->andFilterWhere(['like', 'nseti.params', $this->params])

            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from.' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to.' 23:59:59') : null]);


        $query->joinWith(['ntags' => function ($q) {
            $q->where('ntag.name LIKE "%' . $this->tagsAsString . '%"');
        }]);

        return $dataProvider;
    }
}
