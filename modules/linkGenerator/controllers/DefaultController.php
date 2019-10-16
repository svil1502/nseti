<?php

namespace app\modules\linkGenerator\controllers;

use app\models\Article;
use app\modules\linkGenerator\models\LinkGenerator;
use app\modules\linkGenerator\models\LinksArticlesRelations;
use app\modules\linkGenerator\models\LinkGeneratorSearch;
use app\modules\linkGenerator\services\LinkGeneratorCreator;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class DefaultController extends Controller
{
    /** @var LinkGeneratorCreator */
    private $listCreator;

    public function __construct($id, $module, LinkGeneratorCreator $listCreator)
    {
        parent::__construct($id, $module);
        $this->listCreator = $listCreator;
    }

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


    public function actionIndex()
    {
        $searchModel = new LinkGeneratorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new LinkGenerator();
        $entries = [new LinksArticlesRelations()];
        if (Yii::$app->request->isPost) {
            $result = $this->listCreator->create($model);
            if (!$result['error']) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $model = $result['model'];
            $entries = $result['entries'];
        }
        return $this->render('create', compact('model', 'entries'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $entries = $this->listCreator->setEntryArr($model->linksArticlesRelationses);
        if (Yii::$app->request->isPost) {
            $result = $this->listCreator->create($model);
            if (!$result['error']) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $model = $result['model'];
            $entries = $result['entries'];
        }

        return $this->render('update', compact('model', 'entries'));
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        $model = LinkGenerator::find()
            ->alias('ml')
            ->joinWith('linksArticlesRelationses.article')
            ->where(['ml.id' => $id])
            ->one();
        if ($model) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * поиск в select2
     * @return array
     */
    public function actionSearchArticle()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $term = Yii::$app->request->get('term');
        $results = [
            'results' => Article::find()
                ->select(['id', 'title AS text'])
                ->where(['like', 'title', $term])
                ->asArray()
                ->all()
        ];
        return $results;
    }

    /**
     * нажатие на плюс - добавляем еще одну строку таблицы
     * @return array
     */
    public function actionAddEntry()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = uniqid();
        return [
            'id' => $id,
            'tr' => $this->renderPartial('_entry_form', [
                'minus' => true,
                'entry' => new LinksArticlesRelations(),
                'id' => $id,
            ])
        ];
    }

    /**
     *  событие change() в select2 - подтягиваем данные для соседних полей по артикулу статьи
     * @return Article|array|\yii\db\ActiveRecord|null
     */
    public function actionIntroEntry()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $article_id = Yii::$app->request->post('article_id');
        return Article::find()->select(['title', 'intro'])->where(['id' => $article_id])->asArray()->one();
    }
}
