<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => "O'qituvchilar", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teacher-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("O'chirish", ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ishonchingiz komilmi?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'middle_name',
            'address',
            'phone_number',
            'photo',
            'speciality',
//            'password_hash',
//            'password_reset_token',
//            'auth_key',
            'status',
            'created_at',
            'updated_at',
            'role_group'
        ],
    ]) ?>

</div>
