<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Guruhlar ro'yhati";
$this->params['breadcrumbs'][] = $this->title;
//var_dump(Yii::$app->params['secretKey']); exit;
?>
<div class="rating-groups">

    <div class="row">
        <? if (count($group_list) > 0) : ?>
            <? foreach ($group_list as $group) { ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $group->name ?></h3>

                            <!-- <p>New Orders</p> -->
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="<?= Url::to(['student/list', 'group_id' => $group->id]) ?>"
                           class="small-box-footer">
                            Batafsil <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            <? } ?>
        <? else : ?>
            <div class="col-md-12">
                <h1 class="text-danger">Bu kategoriyada guruh mavjud emas.</h1>
            </div>
        <? endif; ?>
    </div>

</div>
