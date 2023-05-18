<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <p><?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-primary']) ?></p>

    <?php $form = ActiveForm::begin(); ?>
    <div class="actions-form">
        <div class="box box-info box-solid">
            <div class="box-header">
                <div class="box-title"><?= $this->title ?></div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'category_code')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-5">
                        <?= $form->field($model, 'category_details')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'color')->widget(ColorInput::class, ['options' => ['placeholder' => 'เลือกสี'],]); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>