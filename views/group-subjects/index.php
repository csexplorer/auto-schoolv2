<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupSubjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guruh fanlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-subjects-index">

    <p>
        <?= Html::a('Guruh fanlarini yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'group_id',
                'value' => 'group.name'
            ],
            [
                'attribute' => 'subject_id',
                'value' => 'subject.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
