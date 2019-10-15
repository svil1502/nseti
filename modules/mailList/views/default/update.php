<?php
/* @var $this yii\web\View */
/* @var $model app\modules\mailList\models\MailingList */
/* @var $entries \app\modules\mailList\models\MailingListEntry[] */

use yii\helpers\Html;

$this->title = 'Обновить рассылки: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Рассылки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="mailing-list-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', compact('model', 'entries')) ?>
</div>
