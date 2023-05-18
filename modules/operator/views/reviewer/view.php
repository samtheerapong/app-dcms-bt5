<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
// use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Reviewer */

$this->title = $model->requester->document_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviewer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reviewer-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-edit"></span> ' . Yii::t('app', 'Approver'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

    </p>

    <div class="actions-form">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-info box-solid">
                    <div class="box-header">
                        <div class="box-title"><?= Yii::t('app', 'Requester') ?></div>
                    </div>
                    <div class="box-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                            'attributes' => [

                                [
                                    'attribute' => 'requester.document_number',
                                    'format' => 'html',
                                    'value' => $model->requester->document_number,

                                ],
                                [
                                    'attribute' => 'requester.status.status_name',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return '<span class="badge" style="background-color:'
                                            . $model->requester->status->color
                                            . ';"><b>'
                                            . $model->requester->status->status_details
                                            . '</b></span>';
                                    },
                                ],
                                [
                                    'attribute' => 'requester.types_id',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return '<span class="badge" style="background-color:'
                                            . $model->requester->types->color
                                            . ';"><b>'
                                            . $model->requester->types->type_details
                                            . '</b></span>';
                                    },
                                ],

                                [
                                    'attribute' => 'requester.request_by',
                                    'format' => 'html',
                                    'value' => $model->requester->requestBy->profile->name,

                                ],

                                [
                                    'attribute' => 'requester.categories_id',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return '<span class="badge" style="background-color:'
                                            . $model->requester->categories->color . ';"><b>'
                                            . $model->requester->categories->category_code
                                            . ' </b></span> - '
                                            . $model->requester->categories->category_details;
                                    },
                                ],
                                [
                                    'attribute' => 'requester.departments_id',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return '<span class="badge" style="background-color:'
                                            . $model->requester->departments->color . ';"><b>'
                                            . $model->requester->departments->department_code
                                            . '</b></span> - '
                                            . $model->requester->departments->department_details;
                                    },

                                ],
                                'requester.document_title',
                                'requester.details:ntext',
                                // 'requester.created_at:date',
                                [
                                    'attribute' => 'requester.created_at',
                                    'format' => 'date',
                                    'value' => function ($model) {
                                        return $model->requester->created_at;
                                    },
                                ],
                                [
                                    'attribute' => 'requester.created_by',
                                    'format' => 'html',
                                    'value' => $model->requester->createdBy->profile->name,

                                ],
                                'requester.updated_at:date',
                                [
                                    'attribute' => 'requester.updated_by',
                                    'format' => 'html',
                                    'value' => $model->requester->updatedBy->profile->name,
                                ],
                                [
                                    'attribute' => 'requester.covenant',
                                    'format' => 'html',
                                    'value' => $model->requester->listDownloadFiles('covenant')
                                ],
                                [
                                    'attribute' => 'requester.docs',
                                    'format' => 'html',
                                    'value' => $model->requester->listDownloadFiles('docs')
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <div class="box-title"><?= Yii::t('app', 'Reviewer') ?></div>
                    </div>
                    <div class="box-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // [
                                //     'attribute' => 'document_number',
                                //     'format' => 'html',
                                //     'value' => function ($model) {
                                //         return $model->document_number ? $model->document_number : Yii::t('app', '');
                                //     },
                                // ],   
                                [
                                    'attribute' => 'requester.document_number',
                                    'format' => 'html',
                                    'value' => $model->requester->document_number,

                                ],
                                [
                                    'attribute' => 'reviewerName.profile.name',
                                    // 'value' => $model->requester_by,
                                    'value' => function ($model) {
                                        return $model->reviewer_name ? $model->reviewerName->profile->name : Yii::t('app', 'No Reviewer');
                                    },
                                ],
                                [
                                    'attribute' => 'reviewer_at',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        if ($model->reviewer_at !== null) {
                                            $timestamp = strtotime($model->reviewer_at);
                                            $monthNames = [
                                                'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.',
                                                'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.',
                                                'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
                                            ];
                                            $day = date('d', $timestamp);
                                            $month = $monthNames[date('n', $timestamp) - 1];
                                            $year = date('Y', $timestamp);
                                            return "$day $month $year";
                                        } else {
                                            return Yii::t('app', '');
                                        }
                                    },
                                ],

                                [
                                    'attribute' => 'stamps_id',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        if (isset($model->stamps)) {
                                            $massageColor = isset($model->stamps->color) ? $model->stamps->color : 'gray';
                                            $massageName = isset($model->stamps->stamp_name) ? $model->stamps->stamp_name : 'Unknown';
                                            $fullMassage = '<span class="badge" style="background-color:' . $massageColor . ';"><b>' . $massageName . '</b></span>';
                                            return $fullMassage;
                                        } else {
                                            return Yii::t('app', '');
                                        }
                                    },
                                ],

                                                         

                                [
                                    'attribute' => 'document_revision',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return $model->document_revision ? $model->document_revision : Yii::t('app', '');
                                    },
                                ],
                                

                                [
                                    'attribute' => 'document_age',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return $model->document_age ? $model->document_age : Yii::t('app', '');
                                    },
                                ],
                                // 'document_public_at',
                                [
                                    'attribute' => 'document_public_at',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        if ($model->document_public_at !== null) {
                                            $timestamp = strtotime($model->document_public_at);
                                            $monthNames = [
                                                'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.',
                                                'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.',
                                                'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
                                            ];
                                            $day = date('d', $timestamp);
                                            $month = $monthNames[date('n', $timestamp) - 1];
                                            $year = date('Y', $timestamp);
                                            return "$day $month $year";
                                        } else {
                                            return Yii::t('app', '');
                                        }
                                    },
                                ],

                                [
                                    'attribute' => 'document_ref',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return $model->document_ref ? $model->document_ref : Yii::t('app', '');
                                    },
                                ],
                                
                                [
                                    'attribute' => 'points_id',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return $model->points ? $model->points->point_name : Yii::t('app', '');
                                    },
                                ],
                                // 'reviewer_comment:ntext',
                                [
                                    'attribute' => 'reviewer_comment',
                                    'format' => 'ntext',
                                    'value' => function ($model) {
                                        return $model->reviewer_comment ? $model->reviewer_comment : Yii::t('app', '');
                                    },
                                ],
                                // 'additional_training:ntext',
                                [
                                    'attribute' => 'additional_training',
                                    'format' => 'ntext',
                                    'value' => function ($model) {
                                        return $model->additional_training ? $model->additional_training : Yii::t('app', '');
                                    },
                                ],
                                // 'document_tags',
                                [
                                    'attribute' => 'document_tags',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return $model->document_tags ? $model->document_tags : Yii::t('app', '');
                                    },
                                ],
                            ],
                        ]) ?>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-success box-solid">
                    <div class="box-header">
                        <div class="box-title"><?= Yii::t('app', 'Approver') ?></div>
                    </div>
                    <div class="box-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // 'approverName.profile.name',
                                [
                                    'attribute' => 'requester.document_number',
                                    'format' => 'html',
                                    'value' => $model->requester->document_number,

                                ],
                                [
                                    'attribute' => 'approverName.profile.name',
                                    // 'value' => $model->requester_by,
                                    'value' => function ($model) {
                                        return $model->approver_name ? $model->approverName->profile->name : Yii::t('app', 'No Approver');
                                    },
                                ],
                                // 'approver_at:date',
                                [
                                    'attribute' => 'approver_at',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        if ($model->approver_at !== null) {
                                            $timestamp = strtotime($model->approver_at);
                                            $monthNames = [
                                                'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.',
                                                'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.',
                                                'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
                                            ];
                                            $day = date('d', $timestamp);
                                            $month = $monthNames[date('n', $timestamp) - 1];
                                            $year = date('Y', $timestamp); // + 543 Convert to Thai Buddhist year
                                            return "$day $month $year";
                                        } else {
                                            return Yii::t('app', '');
                                        }
                                    },
                                ],
                                [
                                    'attribute' => 'approver_comment',
                                    'format' => 'ntext',
                                    'value' => function ($model) {
                                        return $model->approver_comment ? $model->approver_comment : Yii::t('app', '');
                                    },
                                ],
                            ],
                        ]) ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>