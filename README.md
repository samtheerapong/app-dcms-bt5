<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>



DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

### Install via git
~~~
git clone https://github.com/samtheerapong/app-dcms-bt5.git
~~~

### Update composer
~~~
composer update
~~~


~~~
http://localhost/app-dcms-bt5/web/
~~~

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
      'cookieValidationKey' => '<secret random string goes here>',
],
```

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=database-name',
    'username' => 'sam',
    'password' => 'sam',
    'charset' => 'utf8',
];
```

### Pager bootstrap5

```php
<?php
use yii\bootstrap5\LinkPager;
?>
<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_post',
        'pager' => ['class' => LinkPager::class],
    ]);
?>

<?= GridView::widget([
     'dataProvider' => $dataProvider,
     'filterModel' => $searchModel,
     'pager' => ['class' => LinkPager::class],
     // 'rowOptions' => function ($model, $key, $index, $grid) {
     //     return ['style' => 'background-color:' . $model->requester->status->color . ';']; // Set the background color of the row dynamically
     // },
     'columns' => [
         ['class' => 'yii\grid\SerialColumn'],

         [
             'class' => ActionColumn::class,
             'header' => Yii::t('app', 'Actions'),
             'template' => '<div class="btn-group btn-group-sm" role="group">{view} {update} {delete}</div>',
             'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-eye"></i>', $url, [
                        'title' => Yii::t('app', 'View'),
                        'class' => 'btn btn-info',
                    ]);
                },
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-edit"></i>', $url, [
                        'title' => Yii::t('app', 'Approver'),
                        'class' => 'btn btn-warning',
                    ]);
                },
                'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fas fa-trash"></i>', $url, [
                    'title' => Yii::t('app', 'Delete'),
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
                },
             ],
         ],
    ],
 ]); 
 ?>


```
