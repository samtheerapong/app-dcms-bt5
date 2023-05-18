<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\operator\models\Points;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\operator\models\PointsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Points');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="points-index">

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
                        'point_code',
                        'point_name',
                        // 'sub_points',
                        // [
                        //     'attribute' => 'sub_points',
                        //     'format' => 'html',
                        //     'value' =>  'point_code',
                        //     'filter' => Select2::widget([
                        //         'model' => $searchModel,
                        //         'attribute' => 'sub_points',
                        //         'data' => ArrayHelper::map(Points::find()->all(), 'id', 'point_name'),
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