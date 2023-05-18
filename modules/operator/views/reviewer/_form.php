<?php

use app\modules\operator\models\Points;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//
use yii\helpers\ArrayHelper;
//
use kartik\widgets\Select2;
use kartik\date\DatePicker;
//
use app\modules\operator\models\Requester;
use app\modules\operator\models\User;
use app\modules\operator\models\Stamps;
use app\modules\operator\models\Status;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Reviewer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviewer-form">
    <div class="actions-form">
        <div class="box box-info box-solid">
            <div class="box-header">
                <div class="box-title"><?= Yii::t('app', 'Reviewer')  ?> </div>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">

                    <?= $form->field($modelRequester, 'status_id')->hiddenInput(['value' => ''])->label(false) ?>

                    <div class="col-md-3">
                        <?= $form->field($modelRequester, 'document_number')->textInput(['disabled' =>  true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'requester_id')->dropDownlist(ArrayHelper::map(Requester::find()->all(), 'id', 'document_title'), (['disabled' =>  true])) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'reviewer_name')->widget(Select2::class, [
                            'language' => 'th',
                            'data' => ArrayHelper::map(User::find()->all(), 'id', 'profile.name'),
                            'theme' => Select2::THEME_DEFAULT,
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select...'),
                                // 'required' => true,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'reviewer_at')->widget(
                            DatePicker::class,
                            [
                                'language' => 'th',
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                ]
                            ]
                        ); ?>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-2">
                        <?= $form->field($model, 'document_revision')->textInput(['required' =>  true]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'document_age')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'document_public_at')->widget(
                            DatePicker::class,
                            [
                                'language' => 'th',
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                ]
                            ]
                        ); ?>
                    </div>
              
                    <div class="col-md-2">
                        <?= $form->field($model, 'stamps_id')->dropDownlist(ArrayHelper::map(Stamps::find()->all(), 'id', 'stamp_name'), ['prompt' => Yii::t('app', 'Select...'), 'required' =>  true]) ?>
                    </div>


                    <div class="col-md-3">
                        <?= $form->field($model, 'points_id')->widget(Select2::class, [
                            'language' => 'th',
                            'data' => ArrayHelper::map(Points::find()->all(), 'id', 'point_name'),
                            'theme' => Select2::THEME_DEFAULT,
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select...'),
                                // 'required' => true,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]);
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'document_ref')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'reviewer_comment')->textarea(['rows' => 3]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'additional_training')->textarea(['rows' => 3]) ?>
                    </div>
                </div>


                <?= $form->field($model, 'document_tags')->hiddenInput()->label(false); ?>



                <div class="box box-success box-solid">
                    <div class="box-header">
                        <div class="box-title"><?= $this->title ?></div>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'approver_name')->widget(Select2::class, [
                                    'language' => 'th',
                                    'theme' => Select2::THEME_DEFAULT,
                                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'profile.name'),
                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Select...'),
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="col-md-6">
                                <?= $form->field($model, 'approver_at')->widget(
                                    DatePicker::class,
                                    [
                                        'language' => 'th',
                                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd',
                                            'todayHighlight' => true,
                                            'autoclose' => true,
                                        ]
                                    ]
                                ); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'approver_comment')->textarea(['rows' => 3]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-126">
                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app', Yii::t('app', 'Save')), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>


                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>