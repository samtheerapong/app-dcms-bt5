<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\operator\models\DocumentLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Document Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Document Logs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'requester_id',
            'reviewer_id',
            'created_at',
            'updated_at',
            'document_name',
            'document_revision',
            'document_fullname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
