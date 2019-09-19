

<?php
use yii\helpers\Html;
use yii\grid\GridView;
//use app\modules\admin\models\User;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        //    'id',
            'username',
           // 'password',
           // 'auth_key',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'visibleButtons' => [
                    // 'update' => function($data) { return $data->id !== 1; },
                    'delete' => function($data) { return $data->username !== 'admin'; }
                ]
            ],
        ],
    ]); ?>




</div>






</div>

