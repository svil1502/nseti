<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'status',
            'send_at',
            //'created_at',
            //'updated_at',
            //'user_sent',
            //'user_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
