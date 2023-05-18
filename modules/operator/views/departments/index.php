<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\operator\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\operator\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="actions-form">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <div class="box-title"><?= $this->title ?></div>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'department_code',
                        [
                            'attribute' => 'department_code',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:' . $model->color . ';"><b>' . $model->department_code . '</b></span>';
                            },
                            // 'filter' => Html::activeDropDownList($searchModel, 'id', ArrayHelper::map(Categories::find()->all(), 'id', 'category_code'), ['class' => 'form-control', 'prompt' => 'ทั้งหมด...'])
                        ],
                        'department_details:ntext',
                        // 'color',
                        // 'user_id',
                        // 'user.profile.name',
                        // [
                        //     'attribute' => 'user_id',
                        //     'format' => 'html',
                        //     'value' => 'user.profile.name',
                        //     'filter' => Select2::widget([
                        //         'model' => $searchModel,
                        //         'attribute' => 'user_id',
                        //         'data' => ArrayHelper::map(User::find()->all(), 'id', 'profile.name'),
                        //         'theme' => Select2::THEME_BOOTSTRAP,
                        //         'options' => ['placeholder' => 'เลือก ...'],
                        //         'language' => 'th',
                        //         'pluginOptions' => [
                        //             'allowClear' => true
                        //         ],
                        //     ])
                        // ],

                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'options' => ['style' => 'width:120px;'],
                            'buttonOptions' => ['class' => 'btn btn-default'],
                            'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete}</div>'
                        ],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
