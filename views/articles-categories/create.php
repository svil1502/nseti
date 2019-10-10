<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticlesCategories */

$this->title = 'Create Articles Categories';
$this->params['breadcrumbs'][] = ['label' => 'Articles Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
