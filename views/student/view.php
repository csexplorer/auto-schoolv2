<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => "O'quvchilar", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//echo "<pre>";
//var_dump($m); die();
?>


<div class="student-view">

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
                'start_date',
                'payment',
                [
                    'attribute' => 'category_id',
                    'label' => 'Guruhi',
                    'value' => function ($model) {
                        return $model->group->name;
                    }
                ]
            ],
        ]) ?>

</div>
