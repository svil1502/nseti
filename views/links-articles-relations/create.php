<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LinksArticlesRelations */

$this->title = 'Create Links Articles Relations';
$this->params['breadcrumbs'][] = ['label' => 'Links Articles Relations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-articles-relations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
