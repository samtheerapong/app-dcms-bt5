<?php

namespace app\modules\operator\controllers;

use app\modules\operator\models\DocumentLogs;
use Yii;
use app\modules\operator\models\Requester;
use app\modules\operator\models\RequesterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\operator\models\Reviewer;
use mdm\autonumber\AutoNumber;

//
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;


/**
 * RequesterController implements the CRUD actions for Requester model.
 */
class RequesterController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Requester models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequesterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Requester model.
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
     * Creates a new Requester model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Requester();
        $modelReviewer = new Reviewer();
        $modelDocumentLogs = new DocumentLogs();

        if ($model->load(Yii::$app->request->post())) {

            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
            $this->CreateDir($model->ref);

            $model->covenant = $this->uploadSingleFile($model);
            $model->docs = $this->uploadMultipleFile($model);

            // Get format nimber Ex. FM-GR-001
            $fullname = $model->categories->category_code . '-' . $model->departments->department_code;
            $model->document_number = AutoNumber::generate($fullname . '-???');

            if ($model->save()) {
                $modelReviewer->requester_id = $model->id;
                $modelDocumentLogs->requester_id = $model->id;
                $modelReviewer->save();
                $modelDocumentLogs->save();
            }

            Yii::$app->session->setFlash('success', Yii::t('app', 'Successfully'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelReviewer' => $modelReviewer,
            'modelDocumentLogs' => $modelDocumentLogs,
        ]);
    }

    /**
     * Updates an existing Requester model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tempCovenant = $model->covenant;
        $tempDocs     = $model->docs;

        if ($model->load(Yii::$app->request->post())) {

            $this->CreateDir($model->ref);
            $model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->docs = $this->uploadMultipleFile($model, $tempDocs);

            // Get format nimber Ex. FM-GR-001
            $fullname = $model->categories->category_code . '-' . $model->departments->department_code;
            $model->document_number = AutoNumber::generate($fullname . '-???');

            $model->save();

            Yii::$app->session->setFlash('success', Yii::t('app', 'Successfully'));

            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Requester model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->ref);
        Requester::deleteAll(['ref' => $model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Requester model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Requester the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requester::findOne($id)) !== null) {
            return $model;
        }

        if (($model = Requester::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    /***************** Deletefile ******************/
    public function actionDeletefile($id, $field, $fileName)
    {
        $status = ['success' => false];
        if (in_array($field, ['docs', 'covenant'])) {
            $model = $this->findModel($id);
            $files =  Json::decode($model->{$field});
            if (array_key_exists($fileName, $files)) {
                if ($this->deleteFile('file', $model->ref, $fileName)) {
                    $status = ['success' => true];
                    unset($files[$fileName]);
                    $model->{$field} = Json::encode($files);
                    $model->save();
                }
            }
        }
        echo json_encode($status);
    }

    private function deleteFile($type = 'file', $ref, $fileName)
    {
        if (in_array($type, ['file', 'thumbnail'])) {
            if ($type === 'file') {
                $filePath = Requester::getUploadPath() . $ref . '/' . $fileName;
            } else {
                $filePath = Requester::getUploadPath() . $ref . '/thumbnail/' . $fileName;
            }
            @unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    /***************** Download ******************/
    public function actionDownload($id, $file, $fullname)
    {
        $model = $this->findModel($id);
        if (!empty($model->covenant)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->ref . '/' . $file, $fullname);
        } else {
            $this->redirect(['/requester/view', 'id' => $id]);
        }
    }

    /***************** upload SingleFile ******************/
    private function uploadSingleFile($model, $tempFile = null)
    {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'covenant');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(Requester::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }

    /***************** upload MultipleFile ******************/
    private function uploadMultipleFile($model, $tempFile = null)
    {
        $files = [];
        $json = '';
        $tempFile = Json::decode($tempFile);
        $UploadedFiles = UploadedFile::getInstances($model, 'docs');
        if ($UploadedFiles !== null) {
            foreach ($UploadedFiles as $file) {
                try {
                    $oldFileName = $file->basename . '.' . $file->extension;
                    $newFileName = md5($file->basename . time()) . '.' . $file->extension;
                    $file->saveAs(Requester::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
                    $files[$newFileName] = $oldFileName;
                } catch (Exception $e) {
                }
            }
            $json = json::encode(ArrayHelper::merge($tempFile, $files));
        } else {
            $json = $tempFile;
        }
        return $json;
    }

    /***************** Create Dir ******************/
    private function CreateDir($folderName)
    {
        if ($folderName != NULL) {
            $basePath = Requester::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    /***************** Remove Upload Dir ******************/
    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(Requester::getUploadPath() . $dir);
    }
}
