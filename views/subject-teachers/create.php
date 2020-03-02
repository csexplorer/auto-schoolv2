<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectTeachers */

$this->title = "Fan o'qituvchisini yaratish";
$this->params['breadcrumbs'][] = ['label' => "Fan O'qituvchilari", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-teachers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
