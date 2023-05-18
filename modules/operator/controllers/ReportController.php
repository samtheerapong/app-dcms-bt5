<?php

namespace app\modules\operator\controllers;

use Yii;
use yii\data\ArrayDataProvider;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sql = " SELECT  COUNT(m.id) AS mid , r.category_details
                    FROM requester m
                    LEFT JOIN categories r 
                    ON r.id = m.categories_id
                    GROUP BY m.categories_id";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $graph = [];
        foreach ($data as $d) {
            $graph[] = [
                'type' => 'column',
                'name' => $d['category_details'],
                'data' => [intval($d['mid'])],
            ];
        }

       
        //ArrayDataProvider ส่งให้ตาราง
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['mid', 'category_details'],
            ],
        ]);

        return $this->render('index', [
            'graph' => $graph,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport1()
    {
        $sql = " SELECT  COUNT(m.id) AS mid , r.type_details
                    FROM requester m
                    LEFT JOIN types r 
                    ON r.id = m.types_id
                    GROUP BY m.types_id";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $graph = [];
        foreach ($data as $d) {
            $graph[] = [
                'type' => 'column',
                'name' => $d['type_details'],
                'data' => [intval($d['mid'])],
            ];
        }

       
        //ArrayDataProvider ส่งให้ตาราง
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['mid', 'type_details'],
            ],
        ]);

        return $this->render('report1', [
            'graph' => $graph,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionReport2()
    {
        $sql = " SELECT  COUNT(m.id) AS mid , r.status_details
                    FROM requester m
                    LEFT JOIN status r 
                    ON r.id = m.status_id
                    GROUP BY m.status_id";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $graph = [];
        foreach ($data as $d) {
            $graph[] = [
                'type' => 'column',
                'name' => $d['status_details'],
                'data' => [intval($d['mid'])],
            ];
        }

       
        //ArrayDataProvider ส่งให้ตาราง
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['mid', 'status_details'],
            ],
        ]);

        return $this->render('report2', [
            'graph' => $graph,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport3()
    {

        return $this->render('report3', [
           
        ]);
   
    }

    public function actionReport4()
    {
        return $this->render('report4');
    }
}
