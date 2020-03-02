<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Teacher;
use app\models\Subject;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectTeachers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_id')->dropDownList(
        ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
        [
            'prompt' => 'Fanni tanlang',
        ]
    ) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(
        ArrayHelper::map(Teacher::find()->where(['not', ['id' => 5]])->all(), 'id', 'last_name'),
        [
            'prompt' => "O'qituvchini tanglang",
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
