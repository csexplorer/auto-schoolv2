<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MarksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mark') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?php // echo $form->field($model, 'teacher_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Qayta sozlash', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
