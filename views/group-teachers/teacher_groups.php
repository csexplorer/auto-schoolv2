<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Guruhlar ro'yxati";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rating-groups">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <? if (count($teacher_groups) > 0) : ?>
            <? foreach ($teacher_groups as $group) { ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $group->group->name ?></h3>

                            <!-- <p>New Orders</p> -->
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="<?= Url::to(['subject-teachers/list', 'group_id' => $group->group->id, 'teacher_id' => $group->teacher->id]) ?>"
                           class="small-box-footer">
                            Batafsil <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            <? } ?>
        <? else : ?>
            <div class="col-md-12">
                <h1 class="text-danger">There is no groups in this category</h1>
            </div>
        <? endif; ?>
    </div>

</div>
