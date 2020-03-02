<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubjectTeachersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Fan O'qituvchilari";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-teachers-index">

    <p>
        <?= Html::a("Fan o'qituvchisini yaratish", ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'subject_id',
                'value' => 'subject.name'
            ],
            [
                'attribute' => 'teacher_id',
                'value' => 'teacher.fullName'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
