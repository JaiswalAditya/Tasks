<?php

namespace app\controllers;

use app\models\Certifications;
use app\models\CertificationsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CertificationsController implements the CRUD actions for Certifications model.
 */
class CertificationsController extends Controller
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
    public function actionToggleActiveStatus($model = null, $type = null, $type_id = null){
        // json resposne
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        switch ($model) {
            case 'AC':
                $certification = \app\models\Certifications::findOne(['certification_id' => $type_id]);
                if ($type == "A") {
                    $certification->is_active = !$certification->is_active;
                }
                if ($certification->save(false)) {
                    return [
                        'status' => 200,
                        'success' => true,
                    ];
                }
                break;
        }
    }

    /**
     * Lists all Certifications models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CertificationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Certifications model.
     * @param int $certification_id Certification ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($certification_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($certification_id),
        ]);
    }

    /**
     * Creates a new Certifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Certifications();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                //For English Image Upload
                //get the instance of the uploaded file.
                $imageName = uniqid();
                $model->icon_en_image = UploadedFile::getInstance($model, 'icon_en_image');
                $model->icon_en_image->SaveAs('uploads/' . $imageName . '.' . $model->icon_en_image->extension);
                $fileName = $imageName . '.' . $model->icon_en_image->extension;
                $uploadedImage = getimagesize('uploads/' . $fileName);

                //save the path in db column
                $model->icon_en_image = 'uploads/' . $imageName . '.' . $model->icon_en_image->extension;
                $request = Yii::$app->request->bodyParams;

                //For Abrabic Image Upload
                $imageName = uniqid();
                $model->icon_ar_image = UploadedFile::getInstance($model, 'icon_ar_image');
                $model->icon_ar_image->SaveAs('uploads/' . $imageName . '.' . $model->icon_ar_image->extension);
                $fileName1 = $imageName . '.' . $model->icon_ar_image->extension;
                $uploadedImage = getimagesize('uploads/' . $fileName1);

                //save the path in db column
                $model->icon_ar_image = 'uploads/' . $imageName . '.' . $model->icon_ar_image->extension;
                $request = Yii::$app->request->bodyParams;
                $model->save();
                return $this->redirect(['view', 'certification_id' => $model->certification_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Certifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $certification_id Certification ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($certification_id)
    {
        $model = $this->findModel($certification_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'certification_id' => $model->certification_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Certifications model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $certification_id Certification ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($certification_id)
    {
        $this->findModel($certification_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Certifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $certification_id Certification ID
     * @return Certifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($certification_id)
    {
        if (($model = Certifications::findOne(['certification_id' => $certification_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
