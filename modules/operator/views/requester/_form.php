<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//
use yii\helpers\ArrayHelper;
//
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
//
use app\modules\operator\models\Types;
use app\modules\operator\models\Categories;
use app\modules\operator\models\Departments;
use app\modules\operator\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Requester */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requester-form">

    <p><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-primary']) ?></p>

    <div class="actions-form">
        <div class="box box-success box-solid">
            <div class="box-header">
                <div class="box-title"><?= $this->title ?></div>
            </div>
            <div class="box-body">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'types_id')->dropDownlist(ArrayHelper::map(Types::find()->all(), 'id', 'type_details'), ['prompt' => 'กรุณาเลือก ...',]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'request_by')->widget(Select2::class, [
                            'language' => 'th',
                            'data' => ArrayHelper::map(User::find()->all(), 'id', 'profile.name'),
                            'options' => ['placeholder' => 'เลือก ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'categories_id')->dropDownlist(ArrayHelper::map(Categories::find()->all(), 'id', 'category_details'), ['prompt' => 'กรุณาเลือก ...',]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'departments_id')->dropDownlist(ArrayHelper::map(Departments::find()->all(), 'id', ['department_details']), ['prompt' => 'กรุณาเลือก ...',]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'document_title')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'details')->textarea(['rows' => 3]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'covenant')->widget(FileInput::class, [
                            //'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => $model->initialPreview($model->covenant, 'covenant', 'file'),
                                'initialPreviewConfig' => $model->initialPreview($model->covenant, 'covenant', 'config'),
                                'allowedFileExtensions' => ['pdf'],
                                'showPreview' => true,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false
                            ],
                            // 'options' => [
                            //     'required' => true,
                            // ]

                        ]); ?>

                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'docs[]')->widget(FileInput::class, [
                            'options' => [
                                //'accept' => 'image/*',
                                'multiple' => true
                            ],
                            'pluginOptions' => [
                                'previewFileType' => 'any',
                                'initialPreview' => $model->initialPreview($model->docs, 'docs', 'file'),
                                'initialPreviewConfig' => $model->initialPreview($model->docs, 'docs', 'config'),
                                'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'odt', 'png'],
                                'showPreview' => true,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false,
                                'overwriteInitial' => false,
                                'maxFileCount' => 3,
                            ]
                        ]); ?>

                    </div>
                </div>

                <?= $form->field($model, 'status_id')->hiddenInput(['value' => 1])->label(false); ?>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</div>