<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Guruhga o'tadigan fanlar ro'yhati";
$this->params['breadcrumbs'][] = $this->title;
$user = Yii::$app->user;
?>
<div class="rating-groups">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <? if (count($teacher_subjects) > 0) : ?>
            <? foreach ($teacher_subjects as $group_subject) { ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $group_subject->name ?></h3>

                            <!-- <p>New Orders</p> -->
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="<?= Url::to(['student/mark', 'group_id' => $group_id, 'subject_id' => $group_subject->id]) ?>"
                           class="small-box-footer">
                            Batafsil <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            <? } ?>
        <? else : ?>
            <div class="col-md-12">
                <h1 class="text-danger">Bu guruhda sizning faningiz mavjud emas.</h1>
            </div>
        <? endif; ?>
    </div>

</div>
