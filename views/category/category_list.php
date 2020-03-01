<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Kategoriyalar ro'yxati";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rating-groups">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <? foreach ($category_list as $category) { ?>
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $category->name ?></h3>

                  <!-- <p>New Orders</p> -->
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?=Url::to(['groups/list', 'category_id' => $category->id])?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
        <? } ?>
    </div>
     
</div>
