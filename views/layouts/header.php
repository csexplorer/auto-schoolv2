<?php
use yii\helpers\Html;
use yii\helpers\Url;
//echo "<pre>";
//var_dump(Yii::$app->user->identity); die();
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">E-J</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <?php if (!Yii::$app->user->isGuest) : $user = Yii::$app->user->identity; $avatar = !empty($user->photo) ? '/uploads/'.$user->photo : '/img/default-user.png'; ?>
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=$avatar?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $user->last_name . " " . $user->first_name ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=$avatar?>" class="img-circle" alt="User Image">

                                <p>
                                    <?= $user->last_name . " " . $user->first_name ?>
                                    <br>
                                    <em><?=$user->speciality?></em>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= Url::to(['/teacher/profile'])?>" class="btn btn-default btn-flat">Shaxsiy kabinet</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= Url::to(['/site/logout']) ?>" data-method="post" class="btn btn-default btn-flat">Chiqish</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            <? endif; ?>
        </div>
    </nav>
</header>
