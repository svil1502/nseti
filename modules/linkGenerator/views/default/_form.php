<?php

/* @var $this yii\web\View */
/* @var $model app\modules\linkGenerator\models\LinkGenerator */
/* @var $entries app\modules\linkGenerator\models\LinksArticlesRelations[] */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\linkGenerator\assets\Select2Asset;

use dosamigos\datetimepicker\DateTimePicker;

Select2Asset::register($this);

// адрес для получения списка статей для select2 - ajax запрос
$url_set = Url::to(['search-article']);
// адрес для получения строки таблицы при нажатии на плюс - ajax запрос
$url_add = Url::to(['add-entry']);
// адрес для получения значения соседних полей (title, intro), когда статься выбрана - ajax запрос
$url_add_intro = Url::to(['intro-entry']);

$js = "
    $(function () {
        function setSelect2 (obj) {
            obj.select2({
                language: 'ru',
                placeholder: 'Выберите статью',
                minimumInputLength: 3,
                width: '100%',
                ajax: {
                    url: '$url_set',
                    dataType: 'json',
                    delay: 250,
                    cache: true,
                },
                allowClear: true
            });
        };
        $('.link-generator-select2').each(function () {
            setSelect2 ($(this));
        });
        $(document).on('change', '.link-generator-select2', function () {
            let current = $(this);
            let val = current.val();
            let id  = current.attr('id');
            let titleField = current.parents('tr').find('.title-text');
            let introField = current.parents('tr').find('.intro-text');
            $('.link-generator-select2').each(function () {
                if (val && $(this).attr('id') !== id && $(this).val() === val) {
                    alert('Эта статья уже выбрана!');
                    current.html('<option></option>');
                    return false;
                }
                if (val) {
                    $.post('$url_add_intro', {article_id: val}, function (data) {
                       titleField.val(data.title);
                       introField.val(data.intro);
                       console.log(data);
                    });
                }
            });
        });
        $(document).on('click', '.add-entry', function () {
            let tr = $(this).parents('tr');
            $.post('$url_add', function (data) {
                tr.after(data.tr);
                setSelect2 ($('#' + data.id));
            });
        });
        $(document).on('click', '.delete-entry', function () {
            $(this).parents('tr').remove();
        });
    });
";
$this->registerJs($js, \yii\web\View::POS_END);
?>

<div class="link-generator-form">

    <?= Html::beginForm() ?>

    <div class="form-group">
        <?= Html::activeCheckbox($model, 'status', ['label' => 'Статус'], ['class' => 'form-control']) ?>
        <?= $this->render('_form_error', ['model' => $model, 'field' => 'status']) ?>
    </div>
    <?php
    if($model->send_at){
        $unixtime = strtotime($model->send_at);
        $date = date('Y-m-d', $unixtime);
        $time = date('H:i:s', $unixtime);
        $model->send_at = date('Y-m-d', strtotime($model->send_at));
        $model->sendAtTime = $time;
    }
    ?>
    <div class="form-group">
        <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'send_at',
            'clientOptions' => [
                'weekStart' => 1,
                'minView' => 3,
                'steps' => 60,
                'format' => 'yyyy-mm-dd',
            ]
        ]) ?>

    </div>

    <table class="table table-bordered">
        <tr>
            <th>Статья</th>
            <th>Заголовок</th>
            <th>Лид</th>
            <th></th>
            <th></th>
        </tr>
        <?php $i = 0 ?>
        <?php foreach ($entries as $entry) : ?>
            <?php $minus = $i == 0 ? false : true ?>
            <?= $this->render('_entry_form', ['entry' => $entry, 'minus' => $minus, 'id' => uniqid()]) ?>
            <?= $this->render('_form_error', ['model' =>$entry, 'field' => 'intro']) ?>
            <?php $i++ ?>
        <?php endforeach ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?= Html::endForm() ?>
</div>
