<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

//
use app\modules\operator\models\Categories;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\operator\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', Yii::t('app', 'Create New')), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="actions-form">
        <div class="box box-info box-solid">
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
                        [
                            'attribute' => 'category_code',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:' . $model->color . ';"><b>' . $model->category_code . '</b></span>';
                            },
                            // 'filter' => Html::activeDropDownList($searchModel, 'id', ArrayHelper::map(Categories::find()->all(), 'id', 'category_code'), ['class' => 'form-control', 'prompt' => 'ทั้งหมด...'])
                        ],
                        'category_details',

                        // ['class' => 'yii\grid\ActionColumn'],
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