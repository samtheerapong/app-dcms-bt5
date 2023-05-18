<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\DocumentLogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'requester_id')->textInput() ?>

    <?= $form->field($model, 'reviewer_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_revision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document_fullname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
