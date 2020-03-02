<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */

$this->title = "Davomatni yangilash" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Davomat', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="attendance-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
