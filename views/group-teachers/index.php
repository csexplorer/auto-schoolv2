<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupTeachersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Guruh o'qituvchilari";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-teachers-index">

    <p>
        <?= Html::a("Guruh o'qituvchilarini yaratish", ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'group_id',
                'value' => 'group.name'
            ],
            [
                'attribute' => 'teacher_id',
                'value' => 'teacher.fullName'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
