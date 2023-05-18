<?php

use app\models\Logs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Logs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'document_number',
            'document_revision',
            'document_title',
            'requester_by',
            //'requester_at',
            //'details:ntext',
            //'covenant:ntext',
            //'docs:ntext',
            //'document_age',
            //'document_public_at',
            //'stamps_id',
            //'document_tags',
            //'points_id',
            //'additional_training:ntext',
            //'reviewer_by',
            //'reviewer_at',
            //'reviewer_comment:ntext',
            //'approve_by',
            //'approve_at',
            //'approver_comment:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Logs $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
