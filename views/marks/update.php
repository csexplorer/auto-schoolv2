<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */

$this->title = 'Bahoni yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baholar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="marks-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
