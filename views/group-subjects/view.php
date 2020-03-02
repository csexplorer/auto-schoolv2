<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupSubjects */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Guruh fanlari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="group-subjects-view">

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
            [
                'attribute' => 'group_id',
                'value' => function ($model) {
                    return $model->group->name;
                }
            ],
            [
                'attribute' => 'subject_id',
                'value' => function ($model) {
                    return $model->subject->name;
                }
            ]
        ],
    ]) ?>

</div>
