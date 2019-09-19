<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\python */

$this->title = 'Обновить: ' . $model->question;
$this->params['breadcrumbs'][] = ['label' => 'Чат с куратором', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->question, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>

<div class="python-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_up', [
        'model' => $model,
    ]) ?>

</div>
