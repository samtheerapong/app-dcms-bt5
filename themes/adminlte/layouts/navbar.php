<?php

use yii\helpers\Html;
use yii\bootstrap5\Nav;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-dark">
    <!-- Left navbar links -->
    <ul class="nav navbar-nav">

<li class="dropdown user user-menu">

    <?php

    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
        // ['label' => 'About', 'url' => ['/site/about']],
        // ['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => Yii::t('app', 'Request'), 'url' => ['/operator/requester/index']],
        ['label' => Yii::t('app', 'Reviewer'), 'url' => ['/operator/reviewer/index']],
        ['label' => Yii::t('app', 'Private Document'), 'url' => ['/operator/private-requester/index']],

        [
            'label' => Yii::t('app', 'Reports'), 'options' => ['class' => 'report-link'],'icon' => 'fas fa-chart-pie', 'items' => [
                ['label' => Yii::t('app', 'categories'), 'icon' => 'circle-o text-primary', 'url' => ['/operator/report/index']],
                ['label' => Yii::t('app', 'types'), 'icon' => 'circle-o text-primary', 'url' => ['/operator/report/report1']],
                ['label' => Yii::t('app', 'status'), 'icon' => 'circle-o text-primary', 'url' => ['/operator/report/report2']],
                ['label' => Yii::t('app', 'report3 Calendar'), 'icon' => 'circle-o text-primary', 'url' => ['/operator/report/report3']],
                ['label' => Yii::t('app', 'Ex.'), 'icon' => 'circle-o text-primary', 'url' => ['/operator/report/report4']],
                ['label' => Yii::t('app', 'Logs.'), 'icon' => 'circle-o text-primary', 'url' => ['/operator/document-logs/index']],
            ]
        ],

        [
            'label' => 'สมัครสมาชิก',
            'url' => ['/user/registration/register'],
            'options' => ['class' => 'register-link'],
            'visible' => Yii::$app->user->isGuest,
        ],

        Yii::$app->user->isGuest ?
            ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login'], 'options' => ['class' => 'sign-in-link'],] :
            [
                'label' => '<i class="fa fa-child"></i> สวัสดี!! (' . Yii::$app->user->identity->profile->name . ')',
                'options' => ['class' => 'home-link'],
                'items' => [
                    ['label' => '<i class="fa fa-file"></i>' . Yii::t('app', 'Private Document'), 'url' => ['/operator/private-requester/index']],
                    ['label' => '<i class="fa fa-id-card"></i> โปรไฟล์', 'url' => ['/user/settings/profile']],
                    ['label' => '<i class="fa fa-vcard"></i> บัญชี', 'url' => ['/user/settings/account']],
                    ['label' => '<i class="fa fa-book"></i> จัดการสิทธิ์', 'url' => ['/admin']],
                    ['label' => '<i class="fa fa-users"></i> จัดการผู้ใช้งาน', 'url' => ['/user/admin/index']],
                    [
                        'label' => '<i class="fa fa-cogs"></i>' . Yii::t('app', 'Backend'),
                        'options' => ['class' => 'backend-link'],
                        'items' => [
                            ['label' => Yii::t('app', 'categories'), 'url' => ['/operator/categories/index']],
                            ['label' => Yii::t('app', 'departments'), 'url' => ['/operator/departments/index']],
                            ['label' => Yii::t('app', 'points'), 'url' => ['/operator/points/index']],
                            ['label' => Yii::t('app', 'stamps'), 'url' => ['/operator/stamps/index']],
                            ['label' => Yii::t('app', 'status'), 'url' => ['/operator/status/index']],
                            ['label' => Yii::t('app', 'types'), 'url' => ['/operator/types/index']],
                        ]
                    ],
                    [
                        'label' => '<i class="fa fa-sign-out"></i> ออกจากระบบ',
                        'url' => ['/user/security/logout'],

                        'linkOptions' => [
                            'data-method' => 'post',
                            // 'class' => 'btn btn-block'
                        ]
                    ],

                ]
            ],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false, // ใช้งาน icon
        'items' => $menuItems,

    ]);
    ?>

</li>

</ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?=$assetDir?>/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?=$assetDir?>/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?=$assetDir?>/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->