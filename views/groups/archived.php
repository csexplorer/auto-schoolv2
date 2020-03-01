<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arxivdagi Guruhlar';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(function() {
  $('.restore-archive').on('change', function() {
       $.post('/index.php?r=groups/restore-archive', {id: $(this).data('id')}).done(function( data ) {
           if (data === 'tiklandi') {
               window.location.reload();
           }
       });
  })
})
JS;

$this->registerJs($script);

?>
<div class="groups-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'header' => 'Tiklash',
                'checkboxOptions' => function ($model) {
                    return ['data-id' => $model->id, 'class' => 'restore-archive'];
                }
            ],
//            'id',
            'name',
            [
                'attribute' => 'category_id',
                'label' => 'Category',
                'value' => 'category.name'
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
