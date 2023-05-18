<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Logs $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_revision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requester_by')->textInput() ?>

    <?= $form->field($model, 'requester_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'covenant')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'docs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'document_age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_public_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stamps_id')->textInput() ?>

    <?= $form->field($model, 'document_tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'points_id')->textInput() ?>

    <?= $form->field($model, 'additional_training')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reviewer_by')->textInput() ?>

    <?= $form->field($model, 'reviewer_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reviewer_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'approve_by')->textInput() ?>

    <?= $form->field($model, 'approve_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approver_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
