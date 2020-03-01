<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupSubjects */

$this->title = 'Guruh fanlarini yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Guruh fanlari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-subjects-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
