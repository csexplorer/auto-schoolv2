<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Davomat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attendance-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("O'chirish", ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Ishonchingiz komilmi?,
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status',
            'student_id',
            'subject_id',
            'teacher_id',
            'date',
        ],
    ]) ?>

</div>
