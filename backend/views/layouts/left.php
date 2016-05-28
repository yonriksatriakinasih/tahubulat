<?php
use yii\bootstrap\Html;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?=
                Html::img(\Yii::$app->cv->lihatImageDetail(\Yii::$app->user->identity->pict, "", $kategori = "user"), [
                    'class' => 'img-circle',
                    'alt' => \Yii::$app->user->identity->nama_depan
                ])
                ?>
            </div>
            <div class="pull-left info">
                <p><?= \Yii::$app->user->identity->nama_depan ?></p>
                <?=
                Html::a('<i class="fa fa-circle text-success"></i> Online', '#', [
                ])
                ?>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Cv', 'icon' => 'fa fa-file-text-o', 'url' => ['/cv']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Setting',
                        'icon' => 'fa fa-gears',
                        'url' => '#',
                        'items' => [
                            ['label' => 'User', 'icon' => 'fa fa-group', 'url' => ['/user'],],
                            ['label' => 'Kategori', 'icon' => 'fa fa-file-o', 'url' => ['/kategoricv'],]
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
