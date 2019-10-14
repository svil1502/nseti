<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LinkGeneratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Генератор рассылок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-generator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить рассылку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return !$data->status? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            'send_at',

            //'created_at',
            //'updated_at',
            //'user_sent',
            //'user_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
