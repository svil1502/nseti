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

<?php
$script = <<< JS
// $('.button').click(function(e) {
//    e.preventDefault();
//    thisdata = $(this).attr('data-info');
//    console.log(thisdata);
//  });

//$('#linksarticlesrelations-id-0-article_id').change(function(){
    

//$('#linksarticlesrelations-id-0-article_id').change(function(){   
    //(document.getElementsByName("username")[0].value
   // var per= document.getElementById("bills-id_act").options[i].id;
   //LinksArticlesRelations[id][0][title]
   var id = document.getElementById(LinksArticlesRelations[id]);
   

console.log(id);
//console.log(s);
$.ajax({
url: $(this).data("url"),
dataType: 'json',
method: 'GET',
data: {id: id},
success: function (data, textStatus, jqXHR) {
document.getElementById("input-title").value=data.title;
//document.getElementById("linksarticlesrelations-id-0-title").innerText=data.title;
document.getElementById("my_id").innerText=data.intro;
console.log(data.intro);
$('#my_id').val(data.intro);

},
beforeSend: function (xhr) {

},
error: function (jqXHR, textStatus, errorThrown) {

}
});
});
JS;
$this->registerJs($script);


$form->field($model2, 'article_id')->widget(Select2::className(), [
    'data' => $data,
    //данные при инициализации, в том числе и если в модели уже есть данные для этого поля в формате: [key=>value]
    'options' => [
        'prompt' => 'Выберите статью',
        'id' => 'article_id',
    ],
    'pluginOptions' => [
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => \yii\helpers\Url::to(['link-generator/articles']),
            'dataType' => 'json',
            'delay' => 250,
            'cache' => true,
        ]
    ]
]);


