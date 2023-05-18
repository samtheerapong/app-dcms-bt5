<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Points */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="points-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'point_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'point_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_points')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
