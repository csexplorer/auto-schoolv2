<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Groups;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\GroupTeachers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropDownList(
        ArrayHelper::map(Groups::find()->where(['status' => 1])->all(), 'id', 'name'),
        [
            'prompt' => 'Guruhni tanlang',
        ]
    ) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(
        ArrayHelper::map(Teacher::find()->where(['not', ['id' => 5]])->all(), 'id', 'last_name'),
        [
            'prompt' => "O'qituvchini tanlang",
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
