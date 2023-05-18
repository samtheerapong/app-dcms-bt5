<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\ApproverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reviewer_id') ?>

    <?= $form->field($model, 'approve_name') ?>

    <?= $form->field($model, 'approve_at') ?>

    <?= $form->field($model, 'approve_comment') ?>

    <?php // echo $form->field($model, 'approved') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
