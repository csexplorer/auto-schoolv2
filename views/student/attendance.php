<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "O'quvchilar davomati";
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
 $(function() {
     var saveAttendanceBtn = $('.save-attendance');
     saveAttendanceBtn.hide();
     var lastTh = $('#student-attendances-container thead > tr:first-child > th:last-child').prev();
     var lastTd = $('.last-col');
         lastTh.hide();
         lastTd.hide();
     $('#attendance-date').on('change', function() {
         var selectedDate = $(this).val()
        var intDate = new Date(selectedDate).getTime();
        if (intDate + 24*60*60*1000 > Date.now()) {
            saveAttendanceBtn.show();
            var kun = new Date(selectedDate).getDate().toString();
            var oy = (new Date(selectedDate).getMonth() + 1).toString();
            if (kun < 10) { kun = 0 + kun;}
            if (oy < 10) { oy = 0 + oy;}
            lastTh.text(kun+'/'+oy);
        lastTh.show();
        lastTd.attr('data-date', selectedDate);
         lastTd.show();
        }else {
        alert("Avvalgi sanalarga davomat qilolmaysiz!")}
     })
   $('.attendance-cell').on('dblclick', function() {
     var shu = $(this);
     var input = document.createElement('input');
    input.setAttribute('value', shu.text());
    input.setAttribute('class', 'attendance-editbox');
     shu.html(input);
     shu.find('input').focus();
     saveAttendanceBtn.show();
     $.get('/index.php?r=attendance/get-id', {id: shu.data('id')}).done(function(data) {
       if (data === 'bor') {
           shu.on('change', '.attendance-editbox', function(e) {
               var dat = {
                 id: shu.data('id'),
                 status: e.target.value,
               };
               
                $.post('/index.php?r=attendance/edit', dat).done(function( data ) {
                    shu.html(dat.status);
                });
           })
       } else {
           shu.on('change', '.attendance-editbox', function(e) {
               var dat = {
                   status: e.target.value,
                   groupId: shu.data('grid'),
                   subjectId: shu.data('sjid'),
                   studentId: shu.data('stid'),
                   date: shu.data('date')
               };
               $.post('/index.php?r=attendance/attendance-create', dat).done(function( data ) {
                   if (data === 'saqlandi') {
                       shu.html(dat.status);
                   }
               });
           })
       }
     })
   })
 })
JS;

$this->registerJs($script);

$css = <<<CSS
.attendance-editbox {
    width: 100%;
    border: none;
}
CSS;
$this->registerCss($css);

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'first_name',
        'label' => 'F.I.SH',
        'value' => function ($model) {
            return '<a href="' . yii\helpers\Url::to(['student/view-from-teacher', 'id' => $model->id, 'subject_id' => 1]) . '">' . $model->fullName . '</a>';
        },
        'format' => 'html'
    ],
];
Yii::$app->formatter->locale = 'uz-UZ';
$uniqueDates = array_unique(array_column($attendance, 'date'));
sort($uniqueDates);
foreach ($uniqueDates as $date) {
    $columns[] = [
        'label' => date('d/m', $date),
        'value' => function ($model, $key, $index, $widget) use ($date) {
            $yoq = "";
            $aaa = array_filter($model->attendances, function ($val) use ($date) {
                return $val->date === $date;
            });
            if (count($aaa) > 0) {
                $yoq = array_column($aaa, 'status')[0];
                return $yoq;
            }
            return $yoq;
        },
        'contentOptions' => function ($model) use ($date) {
            $iid = 0;
            $aaa = array_filter($model->attendances, function ($val) use ($date) {
                return $val->date === $date;
            });
            if (count($aaa) > 0) {
                $iid = array_column($aaa, 'id')[0];
            }
            return [
                'class' => 'attendance-cell',
                'data-id' => $iid,
                'data-sjid' => $_GET['subject_id'],
                'data-grid' => $_GET['group_id'],
                'data-stid' => $model->id,
                'data-date' => Yii::$app->formatter->asDate($date)
            ];
        }
    ];
}

$columns[] = [
    'value' => function () {
        return '';
    },
    'contentOptions' => function ($model) {
        return [
            'class' => 'attendance-cell last-col',
            'data-id' => 0,
            'data-sjid' => $_GET['subject_id'],
            'data-grid' => $_GET['group_id'],
            'data-stid' => $model->id,
        ];
    }
];
$columns[] = [
    'header' => '<strong style="font-size: 16px;">Jami</strong>',
    'value' => function ($model) {
        return '<strong style="font-size: 16px">' . count($model->attendances) . '</strong>';
    },
    'format' => 'html'
];
?>
<div class="student-attendances">

    <div class="row ">
        <div class="col-md-9">
            <a href="<?= Url::to(['student/mark', 'group_id' => $group_id, 'subject_id' => $subject_id]) ?>"
               class="btn btn-success" style="margin-right: 16px;">
                Baholash
            </a>
            <a href="<?= Url::to('') ?>"
               class="btn btn-danger">
                Davomat
            </a>
        </div>
        <div class="col-lg-3">
            <?= kartik\date\DatePicker::widget([
                'id' => 'attendance-date',
                'name' => 'attendance_date',
                'type' => 3,
                'removeButton' => false,
                'options' => ['placeholder' => 'Davomat qilish'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>
    </div>


    <?= GridView::widget([
        'id' => 'student-attendances',
        'dataProvider' => $dataProvider,
        'resizableColumns' => true,
        'pjax' => true,
        'columns' => $columns,
    ]); ?>

    <div class="text-right">
        <a class="save-attendance btn btn-success" href="<?= \yii\helpers\Url::to('') ?>">Saqlash</a>
    </div>
</div>
