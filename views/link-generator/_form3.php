<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use app\models\Articles;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\LinkGenerator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-generator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'send_at')->textInput() ?>


    <?=$form->field($model2, 'article_id')->widget(Select2::className(), [
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
    ?>


    <?= $form->field($model2, 'id')->widget(MultipleInput::className(), [
        //'max' => 3,
        // 'row' => 'data-key',
        //'name' => $model2->getAttributeLabel('id'),
        'columns' => [
            [

                'name'  => 'article_id',
                //   'title' => $model2->getAttributeLabel('article_id'),
                'title' => 'Выбор статьи',
                'type' =>  \kartik\select2\Select2::className(),

                // 'options' => ['placeholder' => 'Выбор компании','id'=>'zipCode', 'data-url'=>Url::to(['requisites/prov'])],


                'options' => [
                    'data' => ArrayHelper::map(\app\models\Articles::find()->all(), 'id', 'title'),

                    'options' => [
                        'placeholder' => 'Выбор статьи',
                        'id'=>'zipCode',
                        //    'data-url'=>Url::to(['link-generator/articles']),
                        'pluginEvents'=>[
                            'minimumInputLength'=>3,
                            'ajax'=>[
                                'url'=>\yii\helpers\Url::to(['link-generator/articles']),
                                'data' =>  new JsExpression('function(data) {
           console.log(obj);
           /* obj.term --то что ввёл пользователь, 
            * но вы можете и обработать это ввод пред тем 
            * как отправлять на сервер, 
            * может добавитьдоп. парамерты */
 
           return obj.term;
       }'),
                                'dataType'=>'json',
                                'delay'=>250,
                                'cache'=>true,
                                'results' => new JsExpression('function(data) { 
                                                 document.getElementById("input-title").value=data.title;
                                                 console.log(data.title);
                                                  
                                                  }')

                            ]


                        ]

                    ]
//                       'initValueText' => empty($model->items) ? '' : Item::findOne($model->items)->title,

                ]
            ],

            [
                'name'  => 'title',
                'title' => 'Заголовок',



                // 'enableError' => true,
                'options' => [
                    'class' => 'input-title',
                    'id' => 'input-title',
                ]
            ],
            [
                'name'  => 'intro',
                'title' => 'Лид для статьи',



                'enableError' => true,
                'options' => [
                    'class' => 'input-intro'
                ]
            ]
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
Текст <div id='my_id'></div>
<?php
echo "options";
//var_dump($options);
?>
<button class="button">Кнопка</button>
<?= $form->field($model2, 'article_id')->widget(Select2::classname(), [
    'data' => $data,
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбор статьи ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?>

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

},
beforeSend: function (xhr) {

},
error: function (jqXHR, textStatus, errorThrown) {

}
});
