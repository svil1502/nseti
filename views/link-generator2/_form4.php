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


    <?= $form->field($model2, 'id')->widget(MultipleInput::className(), [
        'columns' => [
            [

                'name'  => 'article_id',
                'title' => 'Выбор статьи',
                'type' =>  \kartik\select2\Select2::className(),
                'options' => [
                    'data' => $data,
                     'options' => [
                        'placeholder' => 'Выбор статьи',
                        'pluginOptions'=>[
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 1,
                                'ajax' => [
                                    'url' => Url::to(['/link-generator/articles']),
                                    'dataType' => 'json',
                                    'delay' => 250,
                                    'data' => new JsExpression('function(params) { return {q:params.term, page: params.page}; }'),
                                    'processResults' => new JsExpression("nn"),
                                    'cache' => true
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('formatProduct'),
                                'templateSelection' => new JsExpression('formatProductSelection'),
                            ],
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



<p>Таблица 4
</p>
<span id="table">
<table border=0 cellspacing=0 cellpadding=3>
<caption>Сведения о детях</caption>
<tr>
  <td>Имя</td>
  <td>Дата рождения</td>
  <td><a href="#" onclick="return addline();">добавить</a></td>
</tr>
<tr id="newline" nomer="[0]">
  <td><input type="text" name="name[0]"></td>
  <td><input type="text" name="date[0]"></td>
  <td valign="top"><a href="#" onclick="return rmline(0);">удалить</td>
</tr>
</table>
</span>
    <?php
$formatJs = <<< 'JS'

var c=0; //счётчик количества строк

function addline()
{
	c++; // увеличиваем счётчик строк
	s=document.getElementById('table').innerHTML; // получаем HTML-код таблицы
	s=s.replace(/[\r\n]/g,''); // вырезаем все символы перевода строк
	re=/(.*)(<tr id=.*>)(<\/table>)/gi; 
                // это регулярное выражение позволяет выделить последнюю строку таблицы

	s1=s.replace(re,'$2'); // получаем HTML-код последней строки таблицы
	s2=s1.replace(/\[\d+\]/gi,'['+c+']'); // заменяем все цифры к квадратных скобках
                // на номер новой строки
	s2=s2.replace(/(rmline\()(\d+\))/gi,'$1'+c+')');
                // заменяем аргумент функции rmline на номер новой строки

	s=s.replace(re,'$1$2'+s2+'$3');
                // создаём HTML-код с добавленным кодом новой строки
	document.getElementById('table').innerHTML=s;
                // возвращаем результат на место исходной таблицы
	return false; // чтобы не происходил переход по ссылке

}

function rmline(q)
{
                 if (c==0) return false; else c--;
                // если раскомментировать предыдущую строчку, то последний (единственный) 
                // элемент удалить будет нельзя.
	s=document.getElementById('table').innerHTML;
	s=s.replace(/[\r\n]/g,'');
	re=new RegExp('<tr id="?newline"? nomer="?\\['+q+'.*?<\\/tr>','gi');
                // это регулярное выражение позволяет выделить строку таблицы с заданным номером

	s=s.replace(re,'');
                // заменяем её на пустое место
	document.getElementById('table').innerHTML=s;
	return false;
}

JS;
$this->registerJs($formatJs, \yii\web\View::POS_HEAD);
?>

let key = 0;
function addRow2() {
let key = 0;
// $(document).on('click', '.double', function() {
let tr = clone($(this).parents('tr'));
key ++;
tr.data('key', key);
let table = $(this).parents('table');
table.append(tr);
}

function deleteRow(row) {
var i = row.parentNode.parentNode.rowIndex;
document.getElementById('POITable').deleteRow(i);
}




<div id="POItablediv">
    <table class="table table-bordered"  id="POITable">
        <tr>
            <th><?= Yii::t('app', 'Выбрать статью') ?></th>
            <th><?= Yii::t('app', 'Наименование') ?></th>
            <th><?= Yii::t('app', 'Лид для статьи') ?></th>
            <th><?= Yii::t('app', '') ?></th>
        </tr>
        <tr class = "my-class" data-key="0" id = "test">

            <th> <?= $form->field($model2, 'title')->textInput(); ?></th>
            <th> <?php echo $form->field($model2, 'article_id')->widget(Select2::classname(), [
                    'data' => $data,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выбор статьи ...', 'id'=>'id_select',
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
                                   // document.getElementById("linksarticlesrelations-title").value=data.title;
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
                ]); ?></th>
            <th><?= $form->field($model2, 'intro')->textInput(); ?></th>
            <th><button  type = "button" class="btn btn-success btn-lg" onclick="insRow()"><span class="glyphicon glyphicon-plus"></span></button>
                <button  type = "button" class="btn btn-danger btn-lg"  onclick="deleteRow(this)"><span class="glyphicon glyphicon-minus"></span></button>
            </th>
        </tr>

    </table>
</div>