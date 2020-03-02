<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = "Shaxsiy kabinet";
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$labels = ['danger', 'success', 'info', 'warning', 'primary'];

$avatar = !empty($model->photo) ? '/uploads/'.$model->photo : '/img/default-user.png';
?>
<div class="teacher-profile">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?= $avatar ?>"
                             alt="User profile picture">

                        <h3 class="profile-username text-center"><?= $user->first_name . " " . $user->last_name ?></h3>

                        <p class="text-muted text-center"><?= $user->speciality ?></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Guruhlari</b> <a
                                        class="pull-right"><?= count($model->groupTeachers) > 0 ? count($model->groupTeachers) : 0 ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Fanlari</b> <a
                                        class="pull-right"><?= count($model->subjectTeachers) > 0 ? count($model->subjectTeachers) : 0 ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hodim haqida</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-phone margin-r-5"></i> Telefon raqami</strong>

                        <p class="text-muted">
                            <?= $model->phone_number ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Yashash manzili</strong>

                        <p class="text-muted"><?= $user->address ?></p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Fanlari</strong>

                        <p>
                            <? $i = 0; foreach ($model->subjectTeachers as $subject) { ?>
                                <span class="label label-<?= $labels[$i] ?>"><?= $subject->subject->name ?></span>
                            <? if (count($model->subjectTeachers) > count($labels)) {
                                $i = 1;
                                } $i++; } ?>
                        </p>

                        <hr>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <?php $form = ActiveForm::begin(['action' => ['/teacher/profile-edit'],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]); ?>

                            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'imageFile')->fileInput() ?>

                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
