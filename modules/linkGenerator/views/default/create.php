<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\linkGenerator\models\MailingList */
/* @var $entries \app\modules\linkGenerator\models\MailingListEntry[] */

$this->title = 'Добавить рассылку';
$this->params['breadcrumbs'][] = ['label' => 'Рассылки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-generator-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', compact('model', 'entries')) ?>

</div>
