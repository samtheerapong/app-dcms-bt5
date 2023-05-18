<?php

use app\modules\operator\models\Points;
use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\operator\models\User;
use app\modules\operator\models\Requester;
use app\modules\operator\models\Stamps;
use app\modules\operator\models\Status;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\operator\models\ReviewerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reviewer');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="reviewer-index">

    <p style="text-align: left;">
        <?= Html::a('<i class="fa fa-arrow-circle-left"></i> ' . Yii::t('app', 'Requester Page'), ['requester/index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app', 'Refresh'), [''], ['class' => 'btn btn-info']) ?>
    </p>


    <div class="actions-form">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <div class="box-title"><?= $this->title ?></div>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'options' => ['style' => 'width:8%;'],
                            'buttonOptions' => ['class' => 'btn btn-default'],
                            'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    if ($model->requester->status->id === 4) {
                                        return '';
                                    } else {
                                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                                            'title' => Yii::t('app', 'Approver'),
                                            'class' => 'btn btn-warning',
                                        ]);
                                    }
                                },
                                'delete' => function ($url, $model, $key) {
                                    if ($model->requester->status->id === 4) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                                'method' => 'post',
                                            ],
                                        ]);
                                    } else {
                                        return '';
                                    }
                                },
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('app', 'View'),
                                        'class' => 'btn btn-info',
                                    ]);
                                },
                            ],
                        ],



                        [
                            'attribute' => 'requester.status_id',
                            'options' => ['style' => 'width:10%;'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'format' => 'html',
                            'value' => function ($model) {
                                $blinkClass = $model->requester->status->id == 1 ? 'blink' : '';
                                return '<span class="badge ' . $blinkClass . '" style="background-color:' . $model->requester->status->color . ';"><b>' . $model->requester->status->status_details . '</b></span>';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'status_id',
                                'data' => ArrayHelper::map(Status::find()->all(), 'id', 'status_details'),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                        // 'requester.document_number',
                        [
                            'attribute' => 'requester.document_number',
                            'options' => ['style' => 'width:8%;'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'format' => 'html',
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'document_number',
                                'data' => ArrayHelper::map(Requester::find()->all(), 'document_number', 'document_number'),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        // 'document_revision',
                        [
                            'attribute' => 'document_revision',
                            'label' => 'Revision',
                            'format' => 'html',
                            'options' => ['style' => 'width:5%;'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'value' => function ($model) {
                                // return $model->document_revision ? $model->document_revision : '<span style="color: red;"> ' . Yii::t('app', 'No Data') . '</span>';
                                return $model->document_revision ? $model->document_revision : '';
                            },
                        ],

                        [
                            'attribute' => 'requester_id',
                            'format' => 'html',
                            'options' => ['style' => 'width:20%;'],
                            'value' => function ($model) {
                                $text = $model->requester->document_title ?? '';
                                if (mb_strlen($text) > 30) {
                                    $text = mb_substr($text, 0, 30) . '...';
                                }
                                return $text;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'requester_id',
                                'data' =>  array_map(function ($value) {
                                    if (mb_strlen($value) > 20) {
                                        $value = mb_substr($value, 0, 20) . '...';
                                    }
                                    return $value;
                                }, ArrayHelper::map(Requester::find()->all(), 'id', 'document_title')),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],


                        // 'reviewer_name',
                        [
                            'attribute' => 'reviewer_name',
                            'format' => 'html',
                            'options' => ['style' => 'width:10%;'],
                            'value' => function ($model) {
                                return $model->reviewer_name ? $model->reviewerName->profile->name : '';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'reviewer_name',
                                'data' => ArrayHelper::map(User::find()->all(), 'id', 'profile.name'),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                        // 'reviewer_at:date',
                        [
                            'attribute' => 'reviewer_at',
                            'options' => ['style' => 'width:8%;'],
                            'format' => 'html',
                            'value' => function ($model) {
                                if ($model->reviewer_at !== null) {
                                    return Yii::$app->formatter->asDate($model->reviewer_at);
                                }
                                return '';
                            },
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'reviewer_at',
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]),
                        ],
                  
                        // 'document_age',
                        // 'document_public_at',
                        [
                            'attribute' => 'document_public_at',
                            'options' => ['style' => 'width:8%;'],
                            'format' => 'html',
                            'value' => function ($model) {
                                if ($model->document_public_at !== null) {
                                    return Yii::$app->formatter->asDate($model->document_public_at);
                                }
                                return '';
                            },
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'document_public_at',
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]),
                        ],
                        // 'stamps_id',
                        [
                            'attribute' => 'stamps_id',
                            'format' => 'html',
                            'options' => ['style' => 'width:8%;'],
                            'contentOptions' => ['class' => 'text-center'], // จัดตรงกลาง
                            'value' => function ($model) {
                                return $model->stamps && $model->stamps->stamp_name ? 
                                '<span class="badge" style="background-color:' . $model->stamps->color . ';"><b>' . $model->stamps->stamp_name . '</b></span>' : 
                                '';
                            },
                            'filter' => Html::activeDropDownList($searchModel, 'stamps_id', ArrayHelper::map(Stamps::find()->all(), 'id', 'stamp_name'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Select...')])
                        ],
                        //'document_ref',
                        //'document_tags',
                        // 'points.point_name',
                        [
                            'attribute' => 'points_id',
                            'format' => 'html',
                            'options' => ['style' => 'width:15%;'],
                            'value' => function ($model) {
                                $value = $model->points ? $model->points->point_name :  '';
                                if (mb_strlen($value) > 20) {
                                    $value = mb_substr($value, 0, 20) . '...';
                                }
                                return $value;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'points_id',
                                'data' =>  array_map(function ($value) {
                                    if (mb_strlen($value) > 18) {
                                        $value = mb_substr($value, 0, 18) . '...';
                                    }
                                    return $value;
                                }, ArrayHelper::map(Points::find()->all(), 'id', 'point_name')),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        //'reviewer_comment:ntext',
                        //'additional_training:ntext',

                    ],
                ]); ?>

            </div>

        </div>
    </div>
</div>