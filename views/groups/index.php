<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guruhlar';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(function() {
  $('.add-archive').on('change', function() {
       $.post('/index.php?r=groups/add-archive', {id: $(this).data('id')}).done(function( data ) {
           if (data === 'arxivlandi') {
                          window.location.reload();
           }
       });
  })
})
JS;

$this->registerJs($script);

?>
<div class="groups-index">

    <p>
        <?= Html::a('Guruh yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'header' => 'Arxiv',
                'checkboxOptions' => function ($model) {
                    return ['data-id' => $model->id, 'class' => 'add-archive'];
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
