<?php

use app\modules\operator\models\Profile;
use yii\helpers\Html;
use yii\widgets\DetailView;

use app\modules\operator\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Requester */

$this->title = $model->document_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requesters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="requester-view">

    <?php if ($model->request_by == Yii::$app->user->identity->profile->user_id) { ?>
        <p>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-edit"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php } else { ?>
        <p>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php } ?>


    <div class="actions-form">
        <div class="card border">
            <div class="card-header bg-info">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                    'attributes' => [

                        [
                            'attribute' => 'document_number',
                            'format' => 'html',
                            // 'value' => $model->document_number,
                            'value' => function ($model) {
                                return '<span style="color:'
                                    . $model->status->color
                                    . ';"><b>' . $model->document_number . '</b></span>';
                            },
                        ],
                        [
                            'attribute' => 'status.status_name',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->status->color
                                    . ';"><b>'
                                    . $model->status->status_details
                                    . '</b></span>';
                            },
                        ],
                        [
                            'attribute' => 'types_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->types->color
                                    . ';"><b>'
                                    . $model->types->type_details
                                    . '</b></span>';
                            },
                        ],

                        [
                            'attribute' => 'request_by',
                            'format' => 'html',
                            'value' => $model->requestBy->profile->name,

                        ],

                        [
                            'attribute' => 'categories_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->categories->color . ';"><b>'
                                    . $model->categories->category_code
                                    . ' </b></span> - '
                                    . $model->categories->category_details;
                            },
                        ],
                        [
                            'attribute' => 'departments_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->departments->color . ';"><b>'
                                    . $model->departments->department_code
                                    . '</b></span> - '
                                    . $model->departments->department_details;
                            },

                        ],
                        'document_title',
                        'details:ntext',
                        // 'created_at:date',
                        [
                            'attribute' => 'created_at',
                            'format' => 'date',
                            'value' => function ($model) {
                                return $model->created_at;
                            },
                        ],
                        [
                            'attribute' => 'created_by',
                            'format' => 'html',
                            'value' => $model->createdBy->profile->name,

                        ],
                        'updated_at:date',
                        [
                            'attribute' => 'updated_by',
                            'format' => 'html',
                            'value' => $model->updatedBy->profile->name,
                        ],
                        [
                            'attribute' => 'covenant',
                            'format' => 'html',
                            'value' => $model->listDownloadFiles('covenant')
                        ],
                        [
                            'attribute' => 'docs',
                            'format' => 'html',
                            'value' => $model->listDownloadFiles('docs')
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>