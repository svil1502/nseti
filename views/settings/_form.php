<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textinput(); ?>

    <?= $form->field($model, 'intro')->textinput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php


$form = ActiveForm::begin();

foreach ($settings as $index => $setting) {
    echo $form->field($setting, "[$index]title")->label($setting->title);
    echo $form->field($setting, "[$index]intro")->label($setting->intro);

}
?>
  <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

 <?php ActiveForm::end(); ?>

<table class="table table-bordered">
<?php foreach ($settings as $index => $setting) : ?>
    <tr>
        <th>Статья</th>
        <th>Заголовок</th>
        <th>Лид</th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td></td>
<td>
    <?=$form->field($setting, "[$index]title")->label($setting->title);?>

</td>
        <td> <?= $form->field($setting, "[$index]intro")->label($setting->intro); ?> </td>
        <td></td>
        <td></td>
    </tr>
  <?php endforeach; ?>
</table>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
<?= Html::endForm() ?>