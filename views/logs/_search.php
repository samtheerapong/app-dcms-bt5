<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LogsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'document_number') ?>

    <?= $form->field($model, 'document_revision') ?>

    <?= $form->field($model, 'document_title') ?>

    <?= $form->field($model, 'requester_by') ?>

    <?php // echo $form->field($model, 'requester_at') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'covenant') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <?php // echo $form->field($model, 'document_age') ?>

    <?php // echo $form->field($model, 'document_public_at') ?>

    <?php // echo $form->field($model, 'stamps_id') ?>

    <?php // echo $form->field($model, 'document_tags') ?>

    <?php // echo $form->field($model, 'points_id') ?>

    <?php // echo $form->field($model, 'additional_training') ?>

    <?php // echo $form->field($model, 'reviewer_by') ?>

    <?php // echo $form->field($model, 'reviewer_at') ?>

    <?php // echo $form->field($model, 'reviewer_comment') ?>

    <?php // echo $form->field($model, 'approve_by') ?>

    <?php // echo $form->field($model, 'approve_at') ?>

    <?php // echo $form->field($model, 'approver_comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
