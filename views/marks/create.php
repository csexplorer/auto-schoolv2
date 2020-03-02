<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */

$this->title = 'Baho yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Baho', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marks-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
