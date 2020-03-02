<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "O'qituvchilar";
$this->params['breadcrumbs'][] = $this->title;

$style = <<< CSS
.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
CSS;

$this->registerCss($style);
?>
<div class="teacher-index">

    <p>
        <?= Html::a("O'qituvchi yaratish", ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'header' => 'Avatar',
                'value' => function($model) {
                    $avatar = !empty($model->photo) ? "/uploads/".$model->photo : "/img/default-user.png";
                    return '<img class="avatar" src="'.$avatar.'" />';
                },
                'format' => 'html'
            ],
            'fullName',
            'address',
            'phone_number',
            //'photo',
            'speciality',
//            'password_hash',
            //'password_reset_token',
            //'auth_key',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'attribute' => 'password',
                'value' => function ($model) {
                    return $model->pass;
                }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
