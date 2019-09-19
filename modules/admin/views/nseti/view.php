<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nseti */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Нейросети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nseti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
         //   'title',
            'question:ntext',
            'description:ntext',
            'type',

           // 'params',

            'tagsAsString',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->params!='')
                        return '<img src="'.Yii::$app->homeUrl. 'uploads/files/'.$model->params.'" width="100%" height="auto">'; else return 'нет картинки';

                },
            ],
        ],
    ]) ?>

</div>
