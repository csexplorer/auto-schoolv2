<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Baholar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marks-index">

    <p>
        <?= Html::a('Baho yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'student_id',
                'label' => 'F.I.SH',
                'value' => 'student.fullName'
            ],
            'mark',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
