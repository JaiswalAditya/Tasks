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
use yii\web\UploadedFile;
use yii;
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

    public function actionExcelImport()
    {
        $model = new  AngularDeveloper();
//        $modelImport = new \yii\base\DynamicModel([
//            'file'=>'File',
//        ]);
//        $modelImport->addRule(['fileImport'],'required');
//        $modelImport->addRule(['fileImport'],'file',['extensions'=>'ods,xls,xlsx'],['maxSize'=>1024*1024]);
        if ($model->load(Yii::$app->request->post())) {
            $excel = UploadedFile::getInstance($model, 'file'); // take a upload file
//            echo '<pre>';
//            print_r($excel);exit();
            if ($excel) {
                $model->file = 'products-import-' . time() . '.' . $excel->extension;
//                print_r($model->file);exit();
                $upload_path = Yii::$app->basePath . '/web/uploads/';
//                print_r($upload_path);exit();
                $path = $upload_path . $model->file;
//                print_r($path);exit();
                $excel->saveAs($path);
                $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//                echo '<pre>';
//                print_r($sheetData);exit();
                $errorCount = 0;
                $errorArr = [];
                $successCount = 0;
                for ($i = 2; $i <= count($sheetData); $i++) {
                    $emp_id= trim($sheetData[$i]['A']);
                    $emp_name= trim($sheetData[$i]['B']);
//                    print_r($emp_name);exit();
                   $emp_age= trim($sheetData[$i]['C']);
                   $no_of_experience= trim($sheetData[$i]['D']);
                    $language_used= trim($sheetData[$i]['E']);
                    $framework_used= trim($sheetData[$i]['F']);
//                    if (!empty($emp_id) && !empty($emp_name)) {
                    $productModel = new AngularDeveloper();
                    $productModel->emp_name = $emp_name; // this will fill a data in table
                    $productModel->emp_age = $emp_age;
                    $productModel->no_of_experience = $no_of_experience;
                    $productModel->language_used = $language_used;
                    $productModel->framework_used = $framework_used;

                        if ($productModel->save()) {
                            $successCount++;
                        } else {
                            echo print_r($productModel->errors);
                            exit;
                        }
                }
                if ($errorCount == 0) {
                    Yii::$app->session->setFlash('success', "{$successCount} Products created successfully.");
                } elseif ($successCount == 0) {
                    Yii::$app->session->setFlash('error', "Products import failed.");
                } else {
                    Yii::$app->session->setFlash('error', "Error occured while adding products for the following rows.<br/> <p>" . implode(', ', $errorArr) . ". <br/>Please fix the errors and try again</p>");
                }
                unlink($path); // remove file from uploads directory
                return $this->refresh();
            }
        }

        return $this->render('excel_import', [
            'model' => $model,
        ]);
    }
}
