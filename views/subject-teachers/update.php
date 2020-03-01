<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectTeachers */

$this->title = "Fan o'qituvchilarini yangilash" . $model->id;
$this->params['breadcrumbs'][] = ['label' => "Fan O'qituvchilari", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="subject-teachers-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
