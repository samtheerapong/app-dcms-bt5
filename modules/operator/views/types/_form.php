<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Types */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'color')->widget(ColorInput::class, ['options' => ['placeholder' => 'เลือกสี'],]); ?> 

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
