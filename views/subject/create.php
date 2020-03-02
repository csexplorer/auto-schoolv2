<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subject */

$this->title = "Fan yaratish";
$this->params['breadcrumbs'][] = ['label' => 'Fanlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
