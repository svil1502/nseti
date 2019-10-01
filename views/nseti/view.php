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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
         //   'title',
            'question:ntext',
            [
                'attribute' => 'description',
                'format' => 'html',
            ],
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
