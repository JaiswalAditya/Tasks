<?php

namespace app\controllers;

use app\models\ProductCategory;
use app\models\ProductCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends Controller
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
     * Lists all ProductCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCategory model.
     * @param int $prod_cat_id Prod Cat ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($prod_cat_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($prod_cat_id),
        ]);
    }

    /**
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProductCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'prod_cat_id' => $model->prod_cat_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionGetList($type) {
        if (isset($type) && $type != "") {
            echo '<option value="">Please select</option>';
            if ($type == 'P') {
                $model = \app\models\ProductCategory::find()
                    ->where([])
                    ->all();
                if (!empty($model)) {
                    foreach ($model as $row) {
                        echo '<option value="' . $row->product_id . '">' . $row->name_en . '</option>';
                    }
                }
            }
        }
    }
    /**
     * Updates an existing ProductCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $prod_cat_id Prod Cat ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($prod_cat_id)
    {
        $model = $this->findModel($prod_cat_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'prod_cat_id' => $model->prod_cat_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $prod_cat_id Prod Cat ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($prod_cat_id)
    {
        $this->findModel($prod_cat_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $prod_cat_id Prod Cat ID
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($prod_cat_id)
    {
        if (($model = ProductCategory::findOne(['prod_cat_id' => $prod_cat_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
