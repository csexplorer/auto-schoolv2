<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guruh fanlari';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rating-groups">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <? if (count($subject_list) > 0) : ?>
            <? foreach ($subject_list as $subject) { ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $subject->subject->name ?></h3>

<!--                             <p>--><?//= $subject->teacher->fullName ?><!--</p> -->
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="<?= Url::to(['site/choose', 'group_id' => $subject->group_id, 'subject_id' => $subject->subject_id]) ?>"
                           class="small-box-footer">
                            Batafsil <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            <? } ?>
        <? else : ?>
            <div class="col-md-12">
                <h1 class="text-danger">Bu guruhda fan mavjud emas.</h1>
            </div>
        <? endif; ?>
    </div>

</div>
