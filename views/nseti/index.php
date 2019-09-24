<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;use yii\widgets\ContentDecorator;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NsetiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

    <?php
$this->title = 'Нейросети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nseti-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       // 'layout' => '{items}{pager}',
        'options' => ['style' => 'width:100%'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'question:ntext',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->params!='')
                        return '<img src="'.Yii::$app->homeUrl. 'uploads/files/'.$model->params.'" width="50px" height="auto">'; else return '<img src="'.Yii::$app->homeUrl. 'img/product.png'.'" width="50px" height="auto">';

                },
            ],
          //  'title',
            'description:ntext',
            'type',
          //  'params',
            [
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'dd.mm.yyyy'],
                ]),
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => 'Дата создания'
            ],
            ['attribute'=>'tagsAsString', 'value'=>'tagsAsString'],

            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],


        ],
    ]); ?>

   </div>
