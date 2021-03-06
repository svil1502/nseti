<?php

use app\models\Article;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\linkGenerator\models\MailingListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рассылки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-generator-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать рассылку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
