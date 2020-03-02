<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "O'quvchilar baholari";
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
 $(function() {
     var saveMarkButton = $('.save-mark');
     saveMarkButton.hide();
     var lastTh = $('#student-marks-container thead > tr:first-child > th:last-child').prev();
     var lastTd = $('.last-col');
         lastTh.hide();
         lastTd.hide();
     $('#mark-date').on('change', function() {
         var selectedDate = $(this).val();
        var intDate = new Date(selectedDate).getTime();
        if (intDate + 24*60*60*1000 > Date.now()) {
            saveMarkButton.show();
            var kun = new Date(selectedDate).getDate().toString();
            var oy = (new Date(selectedDate).getMonth() + 1).toString();
            if (kun < 10) { kun = 0 + kun;}
            if (oy < 10) { oy = 0 + oy;}
            
            lastTh.text(kun+'/'+oy);
        lastTh.show();
        lastTd.attr('data-date', selectedDate);
         lastTd.show();
        }else {
        alert("Siz tanlangan sanaga baho qoyolmaysiz")}
     });
   $('.mark-cell').on('dblclick', function() {
     var shu = $(this);
     var input = document.createElement('input');
    input.setAttribute('value', shu.text());
    input.setAttribute('type', 'number');
    input.setAttribute('class', 'mark-editbox');
     shu.html(input);
     shu.find('input').focus();
     saveMarkButton.show();
     $.get('/index.php?r=marks/get-id', {id: shu.data('id')}).done(function(data) {
       if (data === 'bor') {
           shu.on('change', '.mark-editbox', function(e) {
               var dat = {
                 id: shu.data('id'),
                 mark: e.target.value,
               };
                $.post('/index.php?r=marks/edit', dat).done(function( data ) {
                    shu.html(dat.mark);
                });
           })
       } else {
           shu.on('change', '.mark-editbox', function(e) {
               var dat = {
                   mark: e.target.value,
                   groupId: shu.data('grid'),
                   subjectId: shu.data('sjid'),
                   studentId: shu.data('stid'),
                   date: shu.data('date')
               };
               $.post('/index.php?r=marks/mark-create', dat).done(function( data ) {
                   if (data === 'saqlandi') {
                       shu.html(dat.mark);
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
.mark-editbox {
    width: 100%;
    border: none;
}
.mark-editbox::-webkit-outer-spin-button,
.mark-editbox::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

.mark-editbox[type=number] {
    -moz-appearance:textfield; /* Firefox */
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
$uniqueDates = array_unique(array_column($marks, 'date'));
sort($uniqueDates);
foreach ($uniqueDates as $date) {
    $columns[] = [
        'class' => '\kartik\grid\DataColumn',
        'label' => date('d/m', $date),
        'value' => function ($model, $key, $index, $widget) use ($date) {
            $yoq = "";
            $aaa = array_filter($model->marks, function ($val) use ($date) {
                return $val->date === $date;
            });
            if (count($aaa) > 0) {
                $yoq = array_column($aaa, 'mark')[0];
                return $yoq;
            }
            return $yoq;
        },
        'contentOptions' => function ($model) use ($date) {
            $iid = 0;
            $aaa = array_filter($model->marks, function ($val) use ($date) {
                return $val->date === $date;
            });
            if (count($aaa) > 0) {
                $iid = array_column($aaa, 'id')[0];
            }
            return [
                'class' => 'mark-cell',
                'data-id' => $iid,
                'data-sjid' => $_GET['subject_id'],
                'data-grid' => $_GET['group_id'],
                'data-stid' => $model->id,
                'data-date' => Yii::$app->formatter->asDate($date)
            ];
        },
    ];
}

$columns[] = [
    'value' => function () {
        return '';
    },
    'contentOptions' => function ($model) {
        return [
            'class' => 'mark-cell last-col',
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
        return '<strong style="font-size: 16px">' . $model->totalMarks . '</strong>';
    },
    'format' => 'html'
];
?>
<div class="student-marks">
    <div class="row ">
        <div class="col-md-9">
            <a href="<?= Url::to('') ?>"
               class="btn btn-success" style="margin-right: 16px;">
                Baholash
            </a>
            <a href="<?= Url::to(['student/attendance', 'group_id' => $group_id, 'subject_id' => $subject_id]) ?>"
               class="btn btn-danger">
                Davomat
            </a>
        </div>
        <div class="col-lg-3">
            <?= kartik\date\DatePicker::widget([
                'id' => 'mark-date',
                'name' => 'mark_date',
                'type' => 3,
                'removeButton' => false,
                'options' => ['placeholder' => 'Baho yaratish'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>

    </div>

    <?= GridView::widget([
        'id' => 'student-marks',
        'dataProvider' => $dataProvider,
        'resizableColumns' => true,
        'pjax' => true,
        'columns' => $columns,
    ]); ?>

    <div class="text-right">
        <a class="save-mark btn btn-success" href="<?= \yii\helpers\Url::to('') ?>">Saqlash</a>
    </div>
</div>
