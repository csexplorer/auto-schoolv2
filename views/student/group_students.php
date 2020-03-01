<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Guruh o'quvchilari";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="student-list">

    <p>
        <?= Html::a("O'quvchi yaratish", ['create', 'group_id' => Yii::$app->request->get()["group_id"]], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'first_name',
                'label' => 'F.I.SH',
                'value' => 'fullName'
            ],
            'address',
            'phone_number',
            //'photo',
            'start_date',
            'payment',
            [
                'attribute' => 'group_id',
                'label' => 'Guruhi',
                'value' => 'group.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
