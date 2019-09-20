<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;use yii\widgets\ContentDecorator;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PythonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="content">
    <iframe width='1200' height='380' src='https://embed.coggle.it/diagram/XX9Q7LstyAa29wqG/3d202f71d37ef76077bea08e5b5c0b2080e59bead832d62dc72ce76e50d791fb' frameborder='0' allowfullscreen></iframe>
</div>
    <?php
$this->title = 'Python';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="python-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Тэги', ['tag/'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm}',
                'visibleButtons' => [
                    'confirm' => true,
                ],
                'buttons' => [
                    'confirm' => function ($dataProvider, $model) {

                        return Html::a('', ['uploads/files/'.$model->params], ['class' => 'glyphicon glyphicon-zoom-in']);
                    },


                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confir}',
                'visibleButtons' => [
                    'confirm' => true,
                ],
                'buttons' => [


                    'confir' => function ($dataProvider, $model) {

                        return Html::a('', ['python/download', 'file'=>'uploads/files/'.$model->params], ['class' => 'glyphicon glyphicon-cloud-download']);

                    },
                ],
            ],
        ],
    ]); ?>

   </div>