<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ptag */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Тэги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ptag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
