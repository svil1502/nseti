<?php

namespace app\controllers;


use Yii;
use app\models\Chat;
use app\models\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
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
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public  function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->upload()) {
                return ['error' => null];
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * Displays a single Chat model.
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
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        $model = new Chat();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if (!is_null($image)) {
                $model->title = $image->name; //src
                $ext2 = (explode(".", $image));
                $ext = end($ext2);
                $model->type = $ext; //src
                // generate a unique file name to prevent duplicate filenames
                $model->params = Yii::$app->security->generateRandomString().".{$ext}"; //web
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/files/';
                $path = Yii::$app->params['uploadPath'] . $model->params;
                $image->saveAs($path);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }  else {
                var_dump ($model->getErrors()); die();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Chat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Chat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownload($file) {

        if (file_exists($file)) {
            return \Yii::$app->response->sendFile($file);
        }
        throw new \Exception('File not found');
    }
    public function actionDelete($id)
    {
        $file = new Chat();
        $model = $file->findOne($id);
        unlink('uploads/files/'.$model->params);
        $this->findModel($id)->delete();

//unlink('/path/to/file');
        return $this->redirect(['index']);
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
    }

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::find()->with('tags')->andWhere(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
}
