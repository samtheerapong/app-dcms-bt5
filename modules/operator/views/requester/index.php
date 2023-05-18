<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
//
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
//
use app\modules\operator\models\Types;
use app\modules\operator\models\Status;
use app\modules\operator\models\Categories;
use app\modules\operator\models\Departments;
use app\modules\operator\models\Requester;
use app\modules\operator\models\User;
use yii\bootstrap5\LinkPager;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\operator\models\RequesterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Requester');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requester-index">

    <div style="display: flex; justify-content: space-between;">
        <p style="text-align: left;">
            <?= Html::a('<span class="fas fa-plus"></span> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>

        </p>
        <p style="text-align: right;">
            <?= Html::a('<i class="fas fa-sync-alt"></i> ' . Yii::t('app', 'Refresh'), [''], ['class' => 'btn btn-warning', 'id' => 'refresh-btn']) ?>
            <?= Html::a(Yii::t('app', 'Reviewer Page') . ' <i class="fas fa-arrow-circle-right"></i> ', ['reviewer/index'], ['class' => 'btn btn-secondary']) ?>
        </p>
    </div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="actions-form">
        <div class="card border">
            <div class="card-header bg-info">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => ['class' => LinkPager::class],
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

                        [
                            'attribute' => 'status_id',
                            'options' => ['style' => 'width:10%'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'format' => 'html',
                            'value' => function ($model) {
                                $blinkClass = $model->status->id == 1 ? 'blink' : '';
                                return '<h5><span class="badge ' . $blinkClass . '" style="background-color:' . $model->status->color . ';">' . $model->status->status_details . '</span></h5>';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'status_id',
                                'data' => ArrayHelper::map(Status::find()->all(), 'id', 'status_details'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                        [
                            'attribute' => 'document_number',
                            'options' => ['style' => 'width:10%'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'format' => 'html',
                            'value' => function ($model) {
                                return  $model->document_number;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'document_number',
                                'data' => ArrayHelper::map(Requester::find()->all(), 'document_number', 'document_number'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        [
                            'attribute' => 'document_title',
                            'format' => 'ntext',
                            'options' => ['style' => 'width:20%'],
                            'value' => function ($model) {
                                // ******* ตัดตัวอักษรที่ 50 แล้วใส่ ... ต่อท้าย ******* 
                                $text = $model->document_title;
                                if (mb_strlen($text) > 30) {
                                    $text = mb_substr($text, 0, 30) . '...';
                                }
                                return $text;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'document_title',
                                'data' =>  array_map(function ($value) {
                                    if (mb_strlen($value) > 20) {
                                        $value = mb_substr($value, 0, 20) . '...';
                                    }
                                    return $value;
                                }, ArrayHelper::map(Requester::find()->all(), 'document_title', 'document_title')),
                                'theme' => Select2::THEME_BOOTSTRAP, // Set the theme to 'bootstrap'
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],



                        // 'created_at:date',

                        [
                            'attribute' => 'created_at',
                            'options' => ['style' => 'width:10%'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'format' => 'date',
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'created_at',
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]),
                        ],

                        [
                            'attribute' => 'request_by',
                            'format' => 'html',
                            'options' => ['style' => 'width:10%'],
                            'value' => 'requestBy.profile.name',
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'request_by',
                                'data' => ArrayHelper::map(User::find()->all(), 'id', 'profile.name'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                        [
                            'attribute' => 'categories_id',
                            'format' => 'html',
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'options' => ['style' => 'width:10%'],
                            'value' => function ($model) {
                                return '<h5><span class="badge" style="background-color:' . $model->categories->color . ';">' . $model->categories->category_code . '</span></h5>';
                            },
                            // 'filter' => Html::activeDropDownList($searchModel, 'categories_id', ArrayHelper::map(Categories::find()->all(), 'id', 'category_code'), ['class' => 'form-control', 'prompt' => 'เลือก...'])
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'categories_id',
                                'data' => ArrayHelper::map(Categories::find()->all(), 'id', 'category_code'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        [
                            'attribute' => 'departments_id',
                            'format' => 'html',
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'options' => ['style' => 'width:10%'],
                            'value' => function ($model) {
                                return '<h5><span class="badge" style="background-color:' . $model->departments->color . ';">' . $model->departments->department_code . '</span></h5>';
                            },
                            // 'filter' => Html::activeDropDownList($searchModel, 'departments_id', ArrayHelper::map(Departments::find()->all(), 'id', 'department_code'), ['class' => 'form-control', 'prompt' => 'เลือก...'])
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'departments_id',
                                'data' => ArrayHelper::map(Departments::find()->all(), 'id', 'department_code'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        // 'document_title:ntext',
                        [
                            'attribute' => 'types_id',
                            'options' => ['style' => 'width:10%'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<h5><span class="badge" style="background-color:' . $model->types->color . ';">' . $model->types->type_details . '</span></h5>';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'types_id',
                                'data' => ArrayHelper::map(Types::find()->all(), 'id', 'type_details'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                    ],
                ]); ?>
            </div>
        </div>
    </div>

</div>