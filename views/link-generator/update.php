<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LinkGenerator */

$this->title = 'Update Link Generator: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Link Generators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="link-generator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
