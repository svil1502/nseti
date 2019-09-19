<?php

use app\models\Tag;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nseti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nseti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        //  'options' => ['accept' => 'image/*'],
        'options' =>['required' => true],
        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','pdf'],'showUpload' => false,],
    ]);   ?>

    <?= $form->field($model, 'tags_array')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(Tag::find()->all(),'id','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбрать тэги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
