<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Davomat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-index">

    <p>
        <?= Html::a('Davomat yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status',
            'student_id',
            'subject_id',
            'teacher_id',
            //'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
