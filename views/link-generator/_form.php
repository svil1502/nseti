<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\LinkGenerator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-generator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'send_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
 <?php
foreach($model as $m){
    $data[] = $m['title'];
}
 ?>
<?= $form->field($model2, 'article_id')->widget(Select2::classname(), [
    'data' => $data,
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбор статьи ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);






?>



<?= $form->field($model2, 'article_id')->widget(MultipleInput::className(), [
    //'max' => 3,
    'columns' => [
        [

            'name'  => 'article_id',
            'title' => $model2->getAttributeLabel('article_id'),
            'type' =>  \kartik\select2\Select2::className(),



                'options' => [
                    'data' => ArrayHelper::map(\app\models\Articles::find()->all(), 'id', 'title'),

                        ],

//                       'initValueText' => empty($model->items) ? '' : Item::findOne($model->items)->title,

            ],



        [
            'name'  => 'priority',
            'title' => 'Priority',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ],
        [
            'name'  => 'priority2',
            'title' => 'Priority2',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority2'
            ]
        ]
    ]
]);
?>




