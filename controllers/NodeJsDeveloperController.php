<?php

namespace app\controllers;

use app\models\NodeJsDeveloper;
use app\models\NodeJsDeveloperSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NodeJsDeveloperController implements the CRUD actions for NodeJsDeveloper model.
 */
class NodeJsDeveloperController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all NodeJsDeveloper models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NodeJsDeveloperSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NodeJsDeveloper model.
     * @param int $emp_id Emp ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($emp_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($emp_id),
        ]);
    }

    /**
     * Creates a new NodeJsDeveloper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NodeJsDeveloper();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'emp_id' => $model->emp_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NodeJsDeveloper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $emp_id Emp ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($emp_id)
    {
        $model = $this->findModel($emp_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'emp_id' => $model->emp_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NodeJsDeveloper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $emp_id Emp ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($emp_id)
    {
        $this->findModel($emp_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NodeJsDeveloper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $emp_id Emp ID
     * @return NodeJsDeveloper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($emp_id)
    {
        if (($model = NodeJsDeveloper::findOne(['emp_id' => $emp_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
