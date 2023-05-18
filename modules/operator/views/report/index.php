<?php

use miloschuman\highcharts\Highcharts;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-info">
   <div class="panel-heading">
      <h3 class="panel-title">สรุปแยกเป็นระดับเอกสาร</h3>
   </div>
   <div class="panel-body">
      <?= Highcharts::widget([
         'scripts' => [
            'modules/exporting',
            'themes/grid-light',
         ],
         'options' => [
            'title' => [
               'text' => 'สรุปแยกเป็นระดับเอกสาร',
               'style' => [
                  'fontFamily' => 'Chakra Petch',
               ],
            ],
            'xAxis' => [
               'categories' => ['กลุ่มข้อมูล']
            ],
            'yAxis' => [
               'title' => [
                  'text' => 'จำนวนครั้ง',
                  'style' => [
                     'fontFamily' => 'Chakra Petch',
                  ],
               ],
            ],
            'series' => $graph,
         ]
      ]);
      ?>
   </div>
</div>

<div class="panel panel-info">
   <div class="panel-heading">
      <h3 class="panel-title">ตารางสรุปแยกระดับเอกสาร</h3>
   </div>
   <div class="panel-body">
      <?= GridView::widget([
         'dataProvider' => $dataProvider,
         //'filterModel' => $searchModel,
         'summary' => '',
         'options' => [
            'class' => 'table-responsive',
         ],
         'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'mid',
            [
               'attribute' => 'category_details',
               'label' => 'ระดับเอกสาร',
            ],

            [
               'attribute' => 'mid',
               'label' => 'จำนวนครั้ง',
            ],
            //    [
            //       'class' => 'kartik\grid\ActionColumn',
            //       'options' => ['style' => 'width:120px;'],
            //       'buttonOptions' => ['class' => 'btn btn-default'],
            //       'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete}</div>'
            //   ],
         ],
      ]) ?>
   </div>
</div>