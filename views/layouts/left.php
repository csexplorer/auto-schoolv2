<?php

$user = Yii::$app->user;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $user->can('admin') ? [
                    ['label' => 'ASOSIY MENYULAR', 'options' => ['class' => 'header']],
                    ['label' => 'Baholash / Davomat', 'icon' => 'briefcase', 'url' => ['/teacher/groups']],
                    ['label' => 'Kategoriya', 'icon' => 'briefcase', 'url' => ['/category/index']],
                    ['label' => 'Guruhlar', 'icon' => 'users', 'url' => ['/groups/index']],
                    ['label' => 'O\'quvchilar', 'icon' => 'user', 'url' => ['/student/index']],
                    ['label' => 'Fanlar', 'icon' => 'book', 'url' => ['/subject/index']],
                    ['label' => 'O\'qituvchilar', 'icon' => 'user', 'url' => ['/teacher/index']],
                    ['label' => 'Guruh fanlari', 'icon' => 'users', 'url' => ['/group-subjects/index']],
                    ['label' => 'Guruh o\'qituvchilari', 'icon' => 'users', 'url' => ['/group-teachers/index']],
                    ['label' => 'Fan o\'qituvchilari', 'icon' => 'book', 'url' => ['/subject-teachers/index']],
                    [
                        'label' => 'Arxiv',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Guruhlar', 'icon' => 'book', 'url' => ['/groups/archived'],],
                            ['label' => 'Jurnallar', 'icon' => 'briefcase', 'url' => ['/groups/archived'],],
                        ],
                    ],
                ] : [
                    ['label' => 'ASOSIY MENYULAR', 'options' => ['class' => 'header']],
                    ['label' => 'Guruhlar', 'icon' => 'users', 'url' => ['/teacher/groups']],
                ],
            ]
        ) ?>

    </section>

</aside>
