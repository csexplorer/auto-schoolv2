<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "O'quvchilar";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <p>
        <?= Html::a("O'quvchi yaratish", ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullName',
            'address',
            'phone_number',
            //'photo',
            [
                'attribute' => 'start_date',
                'value' => function ($val) {
                    return date('d.m.Y', $val->start_date);
                }
            ],
            'payment',
            [
                'attribute' => 'group_id',
                'label' => 'Group',
                'value' => 'group.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
