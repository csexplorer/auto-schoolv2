<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Groups;
use app\models\Subject;

/* @var $this yii\web\View */
/* @var $model app\models\GroupSubjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-subjects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropDownList(
        ArrayHelper::map(Groups::find()->where(['status' => 1])->all(), 'id', 'name'),
        [
            'prompt' => 'Guruhni tanlang',
        ]
    ) ?>

    <?= $form->field($model, 'subject_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(\app\models\Subject::find()->all(), 'id', 'name'),
        'language' => 'uz',
        'options' => ['placeholder' => 'Fanlarni tanlang...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
