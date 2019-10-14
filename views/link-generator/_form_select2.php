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



    <?= $form->field($model2, 'article_id')->widget(Select2::classname(), [
        'data' => $data,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбор статьи ...', 'id'=>'id_select',
        ],
        'pluginEvents' => [
            'change' => 'function() {
            var form = $(this).parents("form");
            
             var id = $("#id_select").val();
            console.log(id);
            console.log(form);
                                $.ajax({
                                   
                                    url: "articles",
                                    dataType: "json",
                                    method: "GET",
                                    data: {id: id},
                                    success: function (data, textStatus, jqXHR) {
                                   
                                  
                                    document.getElementById("my_id").innerText=data.intro;
                                    console.log(data);

},
beforeSend: function (xhr) {

},
error: function (jqXHR, textStatus, errorThrown) {

console.log("ошибка");
}
});
            
            }'
//               'ajax' => [
//                'url' => \yii\helpers\Url::to(['link-generator/articles']),
//                'dataType' => 'json',
//                'delay' => 250,
//                'cache' => true,
//            ]
        ],
    ]);

    ?>



    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
Текст <div id='my_id'></div>

