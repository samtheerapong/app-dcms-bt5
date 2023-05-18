<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Approver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reviewer_id')->textInput() ?>

    <?= $form->field($model, 'approve_name')->textInput() ?>

    <?= $form->field($model, 'approve_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'approved')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
