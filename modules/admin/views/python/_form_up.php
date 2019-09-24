<?php

use app\models\Ptag;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Python */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="python-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'question')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'type')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'tags_array')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(Ptag::find()->all(),'id','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбрать тэги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]); ?>
    <?= Html::img('@web/uploads/files/' .$model->params) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

