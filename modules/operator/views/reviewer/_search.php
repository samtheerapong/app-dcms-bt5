<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\ReviewerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviewer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'requester_id') ?>

    <?= $form->field($model, 'reviewer_name') ?>

    <?= $form->field($model, 'reviewer_at') ?>

    <?= $form->field($model, 'document_number') ?>

    <?php // echo $form->field($model, 'document_revision') ?>

    <?php // echo $form->field($model, 'document_age') ?>

    <?php // echo $form->field($model, 'document_public_at') ?>

    <?php // echo $form->field($model, 'stamps_id') ?>

    <?php // echo $form->field($model, 'document_ref') ?>

    <?php // echo $form->field($model, 'document_tags') ?>

    <?php // echo $form->field($model, 'points_id') ?>

    <?php // echo $form->field($model, 'reviewer_comment') ?>

    <?php // echo $form->field($model, 'additional_training') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
