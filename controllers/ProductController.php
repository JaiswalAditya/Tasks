<?php

namespace app\controllers;

//use app\models\Pictures;
use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $p_id P ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($p_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($p_id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
//        print_r($model);exit();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                //get the instance of the uploaded file.
//                $imageName = $model->p_name;
                $imageName = uniqid();
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->image->SaveAs('uploads/' . $imageName . '.' . $model->image->extension);
                if($model->save()){
                    return $this->redirect(['view', 'p_id' => $model->p_id]);
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionGetList($category_id)
    {
        if (isset($category_id) && $category_id != "") {
            echo '<option value="">Please select</option>';
            $model = \app\models\SubCategory::find()
                ->where(['category_id' => '*'])
                ->all();
            if (!empty($model)) {
                foreach ($model as $row) {
                    echo '<option value="' . $row->category_id . '">' . $row->category_name . '</option>';
                }
            }
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $p_id P ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($p_id)
    {
        $model = $this->findModel($p_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'p_id' => $model->p_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $p_id P ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($p_id)
    {
        $this->findModel($p_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $p_id P ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($p_id)
    {
        if (($model = Product::findOne(['p_id' => $p_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
