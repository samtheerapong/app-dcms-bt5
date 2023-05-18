<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Logs $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="logs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'document_number',
            'document_revision',
            'document_title',
            'requester_by',
            'requester_at',
            'details:ntext',
            'covenant:ntext',
            'docs:ntext',
            'document_age',
            'document_public_at',
            'stamps_id',
            'document_tags',
            'points_id',
            'additional_training:ntext',
            'reviewer_by',
            'reviewer_at',
            'reviewer_comment:ntext',
            'approve_by',
            'approve_at',
            'approver_comment:ntext',
        ],
    ]) ?>

</div>
