<?php

namespace app\controllers;

use app\models\Pictures;
use app\models\ProductImages;
use app\models\Products;
use app\models\ProductsSearch;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $product_id Product ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
//                echo "<pre>";
//                print_r($_POST['Products']['tmp_product_id']);exit();
                $images = UploadedFile::getInstances($model, 'product_image');
                if($model->save()){
                    if (!empty($model->tmp_product_id)) {
                        $productImages = ProductImages::find()->where([
                            'tmp_product_id' => $model->tmp_product_id
                        ])->all();
                        foreach ($productImages as $productImage) {
                            $productImage->product_id = $model->product_id;
                            $productImage->save(false);
                        }
                    }
                    return $this->redirect(['view', 'product_id' => $model->product_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpload() {
        $files = array();
        $allwoedFiles = ['jpg', 'png'];
        if ($_POST['is_post'] == 'update') {
            $product_id = $_POST['product_id'];
            if ($_FILES) {
                // debugPrint($_FILES);exit;
                $tmpname = $_FILES['Products']['tmp_name']['product_images'][0];
                $fname = $_FILES['Products']['name']['product_images'][0];
                //Get the temp file path
                $tmpFilePath = $tmpname;
                //Make sure we have a filepath
                if ($tmpFilePath != "") {
                    //save the filename
                    $shortname = $fname;
                    $size = $_FILES['Products']['size']['product_images'][0];
                    $ext = substr(strrchr($shortname, '.'), 1);
                    if (in_array($ext, $allwoedFiles)) {
                        //save the url and the file
                        $uid = uniqid(time(), true);
                        $newFileName = $uid . "." . $ext;
                        //Upload the file into the temp dir
                        if (move_uploaded_file($tmpFilePath, 'uploads/' . $newFileName)) {

                            $newProductImage = new ProductImages();
                            $newProductImage->product_id = $product_id;
                            $newProductImage->image = $newFileName;

                            $newProductImage->save(false);
                            $files['initialPreview'] = Url::base(TRUE) . '/uploads/' . $newFileName;
                            $files['initialPreviewAsData'] = true;
                            $files['initialPreviewConfig'][]['key'] = $newProductImage->product_image_id;
                            return json_encode($files);
                        }
                    }
                }
            }
            return json_encode($files);
        } else {
            if (isset($_POST)) {
                if ($_FILES) {
                    if ($_FILES) {
//                print_r($_FILES);exit;
                        $tmpname = $_FILES['Products']['tmp_name']['product_images'][0];
                        $fname = $_FILES['Products']['name']['product_images'][0];
                        //Get the temp file path
                        $tmpFilePath = $tmpname;
                        //Make sure we have a filepath
                        if ($tmpFilePath != "") {
                            //save the filename
                            $shortname = $fname;
                            $size = $_FILES['Products']['size']['product_images'][0];
                            $ext = substr(strrchr($shortname, '.'), 1);
                            if (in_array($ext, $allwoedFiles)) {
                                //save the url and the file
                                $uid = uniqid(time(), true);
                                $newFileName = $uid . "." . $ext;
                                //Upload the file into the temp dir
                                if (move_uploaded_file($tmpFilePath, 'uploads/' . $newFileName)) {
                                    $newProductImage = new ProductImages();
//                            print_r($_POST);exit;
                                    $newProductImage->product_id = null;
                                    $newProductImage->tmp_product_id = $_POST['uniqueId'];
                                    $newProductImage->image = $newFileName;

                                    $newProductImage->save(false);
                                    $files['initialPreview'] = Url::base(TRUE) . '/uploads/' . $newFileName;
                                    $files['initialPreviewAsData'] = true;
                                    $files['initialPreviewConfig'][]['key'] = $newProductImage->product_id;
                                    return json_encode($files);
                                }
                            }
                        }
                    }
                    return json_encode($files);
                }
            }
        }
    }

    public function actionDeleteImage() {
        $key = $_POST['key'];

        if (is_numeric($key)) {
            $product_image = \app\models\ProductImages::find()
                ->where([
                    'OR',
                    ['product_image_id' => $key],
                    ['tmp_product_id' => $key],

                ])->one();
            $filename=Yii::getAlias('@webroot') . '/uploads/' . $product_image->image;
            if (file_exists($filename)) {
                unlink($filename);
            }
            $product_image->delete();
            return true;
        }
    }
    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $product_id Product ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id)
    {
        $model = $this->findModel($product_id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $product_id Product ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id)
    {
        $this->findModel($product_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $product_id Product ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id)
    {
        if (($model = Products::findOne(['product_id' => $product_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
