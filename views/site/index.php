<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = "Kategoriyalar ro'yhati";
?>
<div class="site-index">

    <div class="jumbotron">

        <div class="rating-groups">
            <div class="row">
                <? if (count($categories) > 0) : ?>
                    <? $i = 1; foreach ($categories as $category) { ?>
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?= $i . ". ". $category->name ?></h3>
                                </div>
                                <a href="<?= Url::to(['groups/list', 'category_id' => $category->id]) ?>"
                                   class="small-box-footer">
                                    Batafsil <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    <? $i++;} ?>
                <? else : ?>
                    <div class="col-md-12">
                        <h1 class="text-danger">Tizimda kategoriya mavjud emas.</h1>
                    </div>
                <? endif; ?>
            </div>

        </div>

    </div>

    <div class="body-content">

    </div>
</div>
