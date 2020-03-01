<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupTeachers */

$this->title = "Guruh o'qituvchilarini yangilash: " . $model->id;
$this->params['breadcrumbs'][] = ['label' => "Guruh O'qituvchilari", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="group-teachers-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
