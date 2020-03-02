<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupSubjects */

$this->title = 'Guruh fanlarini yangilash ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Guruh fanlari', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="group-subjects-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
