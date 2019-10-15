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

    <?= $form->field($model, 'status')->textInput()->checkbox([ '0', '1', ]) ?>


    <?=$form->field($model, 'send_at')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]);
    ?>

    <table class="table table-bordered" id="POITable" border="1">
        <tr>
            <td><?= Yii::t('app', '№') ?></td>
            <td><?= Yii::t('app', 'Выбрать статью') ?></td>
            <td><?= Yii::t('app', 'Наименование') ?></td>
            <td><?= Yii::t('app', 'Лид для статьи') ?></td>
            <td><?= Yii::t('app', 'Добавить/удалить') ?></td>
        </tr>
        <tr id = "line">
            <td id = "number">1</td>
            <td><?php echo $form->field($model2, 'article_id')->widget(Select2::classname(), [
                    'data' => $data,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выбор статьи ...', 'id'=>'id_select',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'pluginEvents' => [

                        'change' => 'function() {
           // var form = $(this).parents("form");
            
             var id = $("#id_select").val();
            console.log(id);
           // console.log(form);
                                $.ajax({
                                   
                                    url: "'. Url::to(["link-generator/articles"]) .'",
                                    dataType: "json",
                                    method: "GET",
                                    data: {id: id},
                                    success: function (data, textStatus, jqXHR) {
                                    document.getElementById("linksarticlesrelations-title").value=data.title;
                                    document.getElementById("linksarticlesrelations-intro").value=data.intro;
                                    },
                                    beforeSend: function (xhr) {
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                    
                                    console.log("ошибка");
                                    }
                                    });
                                                
                                                }'

                    ],
                ])->label(false); ?></td>
            <td><?= $form->field($model2, 'title')->textInput()->label(false); ?></td>
            <td><?= $form->field($model2, 'intro')->textInput()->label(false); ?></td>
            <td><button type="button" class="btn btn-danger" id="delPOIbutton"  onclick="deleteRow(this)" /><span class="glyphicon glyphicon-minus">
            <button type="button" class="btn btn-success" id="addmorePOIbutton" onclick="insRow()" /><span class="glyphicon glyphicon-plus"></span></td>
        </tr>
    </table>


    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>




<?php
$formatJs = <<< 'JS'

function deleteRow(row) {
   
  var i = row.parentNode.parentNode.rowIndex;
  
  document.getElementById('POITable').deleteRow(i);
 
}


function insRow() {

  var x = document.getElementById('POITable');
document.getElementById('delPOIbutton').style.display = "block";
document.getElementById('addmorePOIbutton').style.display = "none";
 var new_row  = document.getElementById("line").cloneNode(true);
document.getElementById('addmorePOIbutton').style.display = "block";
document.getElementById('delPOIbutton').style.display = "none";
  var len = x.rows.length;
  new_row.cells[0].innerHTML = len;
  x.appendChild(new_row);
 
}




JS;
$this->registerJs($formatJs, \yii\web\View::POS_HEAD);
?>
