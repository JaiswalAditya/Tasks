<?php

namespace app\controllers;

use app\models\AngularDeveloper;
use app\models\AngularDeveloperSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\components\UserIdentity;

/**
 * AngularDeveloperController implements the CRUD actions for AngularDeveloper model.
 */
class AngularDeveloperController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' =>  \app\helpers\PermissionHelper::getUserPermissibleAction(3),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => [
                            UserIdentity::ROLE_ADMIN
                        ]
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AngularDeveloper models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AngularDeveloperSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AngularDeveloper model.
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
     * Creates a new AngularDeveloper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AngularDeveloper();

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
     * Updates an existing AngularDeveloper model.
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
     * Deletes an existing AngularDeveloper model.
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
     * Finds the AngularDeveloper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $emp_id Emp ID
     * @return AngularDeveloper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($emp_id)
    {
        if (($model = AngularDeveloper::findOne(['emp_id' => $emp_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
