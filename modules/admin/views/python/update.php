<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Python */

$this->title = 'Обновить: ' . $model->question;
$this->params['breadcrumbs'][] = ['label' => 'Python', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->question, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>

<div class="python-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_up', [
        'model' => $model,
    ]) ?>

</div>
