<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = 'Guruh yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Guruhlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
