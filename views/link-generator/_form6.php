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

    <table class="table table-bordered" id="POITable" border="1">
        <tr>
            <td>POI</td>
            <td>Latitude</td>
            <td>Longitude</td>
            <td>Delete?
                Add Rows?</td>
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
                                  //  document.getElementById("linksarticlesrelations-intro").value=data.intro;
                                    },
                                    beforeSend: function (xhr) {
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                    
                                    console.log("ошибка");
                                    }
                                    });
                                                
                                                }'

                    ],
                ]); ?></td>
            <td><?= $form->field($model2, 'title')->textInput(); ?></td>
            <td><button type="button" class="btn btn-danger btn-lg" id="delPOIbutton"  onclick="deleteRow(this)" /><span class="glyphicon glyphicon-minus">
            <button type="button" class="btn btn-success btn-lg" id="addmorePOIbutton" onclick="insRow()" /><span class="glyphicon glyphicon-plus"></span></td>
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
   console.log(i);
  document.getElementById('POITable').deleteRow(i);
 // document.getElementById('addmorePOIbutton').style.display = "none";
  //document.getElementById('delPOIbutton').style.display = " ";
}

function hide_min(){
   document.getElementById('delPOIbutton').style.visibility = 'hidden';
  }
  
  function vis_min(){
   document.getElementById('delPOIbutton').style.visibility = 'visible';
  }
  
function hide_plus(){
   document.getElementById('addmorePOIbutton').style.visibility = 'hidden';
  }

function vis_plus(){
   document.getElementById('addmorePOIbutton').style.visibility = 'visible';
  }
function insRow() {
    let cell = event.target;
       let i2 = cell.parentNode.rowIndex;
  let j = cell.cellIndex;
    // var i = row.parentNode.parentNode.rowIndex;
    vis_min();

    // document.getElementById('delPOIbutton').style.display = "none";
//document.getElementById('addmorePOIbutton').style.display = " ";

  //console.log(i);
  var x = document.getElementById('POITable');
  //var but_success = document.getElementById('addmorePOIbutton');
  
   console.log(i2, j);
   function hide_plus(cell){
   document.getElementById('addmorePOIbutton').style.visibility = 'hidden';
  }
  
 var new_row  = document.getElementById("line").cloneNode(true);
 console.log(i2, j);
  var len = x.rows.length;
  new_row.cells[0].innerHTML = len;
var new_number  = document.getElementById("number").innerHTML;
  console.log(new_number);
  

//var new_row  = document.getElementById("line").cloneNode(true);
  // var inp1 = new_row.cells[1].getElementsByTagName('select')[0];
  // inp1.id += len;
  // inp1.value = '';
  // var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
  // inp2.id += len;
  // inp2.value = '';
  x.appendChild(new_row);
  console.log(i2, j);
}
hide_min();



JS;
$this->registerJs($formatJs, \yii\web\View::POS_HEAD);
?>

