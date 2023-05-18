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
        <div class="box box-info box-solid">
            <div class="box-header">
                <div class="box-title"><?= $this->title ?></div>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                    'attributes' => [
                        // 'id',
                        // 'ref',
                        // 'fullname',
                        'document_number',
                        [
                            'attribute' => 'types_id',
                            'value' => $model->types->type_name,
                        ],
                        [
                            'attribute' => 'status_id',
                            'value' => $model->status->status_name,
                        ],
                        [
                            'attribute' => 'request_by',
                            'value' => $model->requestBy->profile->name,
                        ],
                        [
                            'attribute' => 'categories_id',
                            'value' => function ($model) {
                                return $model->categories->category_code . ' - ' . $model->categories->category_details;
                            },

                        ],
                        [
                            'attribute' => 'departments_id',
                            'value' => function ($model) {
                                return $model->departments->department_code . ' - ' . $model->departments->department_details;
                            },
                        ],
                        // 'reviewers.document_number',
                        'document_title',
                        'details:ntext',
                        // 'pdf_file:ntext',

                        'created_at:date',
                        'updated_at:date',
                        [
                            'attribute' => 'created_by',
                            'value' => $model->createdBy->profile->name,

                        ],
                        [
                            'attribute' => 'updated_by',
                            'value' => $model->updatedBy->profile->name,
                        ],
                        ['attribute' => 'covenant', 'value' => $model->listDownloadFiles('covenant'), 'format' => 'html'],
                        ['attribute' => 'docs', 'value' => $model->listDownloadFiles('docs'), 'format' => 'html'],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>