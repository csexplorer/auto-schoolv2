<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupTeachers */

$this->title = "Guruh o'qituvchisini yaratish";
$this->params['breadcrumbs'][] = ['label' => "Guruh o'qituvchilari", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-teachers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
