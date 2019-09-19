<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Python */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Чат с куратором', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="python-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
