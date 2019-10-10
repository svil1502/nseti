<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LinkGenerator */

$this->title = 'Добавить рассылку';
$this->params['breadcrumbs'][] = ['label' => 'Генератор рассылок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-generator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
