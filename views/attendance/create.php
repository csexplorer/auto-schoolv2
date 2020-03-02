<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */

$this->title = 'Davomat yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Davomat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
