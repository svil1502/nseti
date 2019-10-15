<?php
/* @var $this yii\web\View */
/* @var $model app\modules\linkGenerator\models\LinkGenerator */
/* @var $entries \app\modules\linkGenerator\models\LinksArticlesRelations[] */

use yii\helpers\Html;

$this->title = 'Обновить рассылку: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Рассылка', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="link-generator-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', compact('model', 'entries')) ?>
</div>
