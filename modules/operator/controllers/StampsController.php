<?php

namespace app\modules\operator\controllers;

use Yii;
use app\modules\operator\models\Stamps;
use app\modules\operator\models\StampsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//
use yii\web\UploadedFile;

/**
 * StampsController implements the CRUD actions for Stamps model.
 */
class StampsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stamps models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StampsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stamps model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stamps model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stamps();

        if ($model->load(Yii::$app->request->post())) {


            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stamps model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {


            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stamps model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stamps model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stamps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stamps::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionUpload()
    {
        $uploadDir = 'uploads/stamp/'; // the directory where uploaded files are saved
        $uploadUrl = Yii::getAlias('@web/' . $uploadDir); // the URL of the directory where uploaded files are saved

        $uploadedFile = UploadedFile::getInstanceByName('upload');

        $fileName = $uploadedFile->baseName . '.' . $uploadedFile->extension;
        $filePath = $uploadDir . $fileName;

        if ($uploadedFile->saveAs($filePath)) {
            $url = $uploadUrl . $fileName;

            $response = new \StdClass;
            $response->uploaded = 1;
            $response->fileName = $fileName;
            $response->url = $url;

            echo stripslashes(json_encode($response));
        } else {
            $response = new \StdClass;
            $response->uploaded = 0;
            $response->error = 'Failed to upload file';

            echo stripslashes(json_encode($response));
        }
    }
}
