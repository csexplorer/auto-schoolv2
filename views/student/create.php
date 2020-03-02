<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = "O'quvchi yaratish";
$this->params['breadcrumbs'][] = ['label' => "O'quvchilar", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
