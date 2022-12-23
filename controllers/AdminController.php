<?php

namespace app\controllers;

use app\models\Admin;
use app\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\widgets\LinkPager;
use \yii\data\Pagination;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\components\UserIdentity;

use Yii;

class AdminController extends Controller
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
                'only' =>   ['index', 'view', 'create', 'update'],
                
                'rules' => [
                    [
                        'actions' => \app\helpers\PermissionHelper::getUserPermissibleAction(1),
                        'allow' => true,
                        'roles' => [
                            UserIdentity::ROLE_ADMIN
                        ]
                    ],
                ],
            ],
        ];
        // return array_merge(
        //     parent::behaviors(),
        //     [
        //         'verbs' => [
        //             'class' => VerbFilter::className(),
        //             'actions' => [
        //                 'delete' => ['POST'],
        //             ],
        //         ],
        //     ]
        // );

    }

    /**
     * Lists all Admin models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $this->layout = false;
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // $json = \Yii::$app->session['_LemonPerfectUserPermissibleItem'];
        // $perm = json_decode($json, true);
 
        // echo "<pre>";
        // print_r(\app\helpers\PermissionHelper::getUserPermissibleAction(1));
        // // print_r($perm);
        // exit;
       

       // build a DB query to get all articles with status = 1
        $query = Admin::find()->where(['id' => 1]);
        // get the total number of Admin (but do not fetch the admin data yet)
        $countQuery = clone $query;
        // create a pagination object with the total count
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        // limit the query using the pagination and retrieve the admin
        $models = $query->offset($pages->offset)
             ->limit($pages->limit)
             ->all();
 
       
       return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'models' => $models,
        'pages' => $pages,
    ]);
    }

    /**
     * Displays a single Admin model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new Admin();

    //     if ($this->request->isPost) {
    //         // echo print_r($this->request->post()['Admin']['password']);exit;

    //         if ($model->load($this->request->post())) {
    //             // $model->password = Security::generatePasswordHash($this->password_field);
    //             $model->password = \Yii::$app->security->generatePasswordHash($this->request->post()['Admin']['password']);

    //                 if($model->save()){
    //                     return $this->redirect(['view', 'id' => $model->id]);

    //                 }

    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * Updates an existing Admin model.
    //  * If update is successful, the browser will be redirected to the 'view' page.
    //  * @param int $id ID
    //  * @return string|\yii\web\Response
    //  * @throws NotFoundHttpException if the model cannot be found
    //  */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }
    public function actionCreate()
    {
        $model = new Admin();
        $modules = \app\models\AuthModule::find()
        ->orderBy(['auth_module_name' => SORT_ASC])
        // ->where(['is_active' => 1])
        ->asArray()
        ->all();

        $result = [];

        foreach ($modules as $row) {
            $row['items'] = $this->getModuleItem($row['auth_module_id']);
            array_push($result, $row);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $request = Yii::$app->request->bodyParams;

                $password = $request['Admin']['password'];
                $model->password = Yii::$app->security->generatePasswordHash($password);
                $model->is_active = 1;

                if($model->save(false)){

                    if (!empty($request['item_list'])) {
                        foreach ($request['item_list'] as $item) {
                            $assignment = new \app\models\AuthAssignment();
                            $assignment->auth_item_id = $item;
                            $assignment->user_id = $model->id;
                            $assignment->user_type = 'A';
                            $assignment->created_at = date('Y-m-d H:i:s');

                            if (!$assignment->save()) {
                                die(json_encode($assignment->errors));
                            }
                        }
                    }

                    return $this->redirect(['index', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'result' => $result,
            'id' => -1
        ]);
    }
 
    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $admin_id Admin ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $imageAdmin = \app\models\Admin::findOne(['id' => $id]);

        $model = $this->findModel($id);
        $modules = \app\models\AuthModule::find()
        ->orderBy(['sort_order' => SORT_ASC])
        ->where(['is_active' => 1])
        ->asArray()
        ->all();
        $result = [];
        foreach ($modules as $row) {
            $row['items'] = $this->getModuleItem($row['auth_module_id']);
            array_push($result, $row);
        }
        if ($this->request->isPost && $model->load($this->request->post())) {
            $request = Yii::$app->request->bodyParams;
            
            if($model->save(false)){
                if (!empty($request['item_list'])) {
                    \app\models\AuthAssignment::deleteAll('user_id = :user_id', [':user_id' => $model->id]);
                    foreach ($request['item_list'] as $item) {
                        $assignment = new \app\models\AuthAssignment();
                        $assignment->auth_item_id = $item;
                        $assignment->user_id = $model->id;
                        $assignment->user_type = 'A';
                        $assignment->created_at = date('Y-m-d H:i:s');
                        if (!$assignment->save(false)) {
                            die(json_encode($assignment->errors));
                        }
                    }
                    Yii::$app->session->setFlash('success', 'Admin successfully updated');
                    return $this->redirect(['index']);
                }
                Yii::$app->session->setFlash('success', 'Admin successfully updated');
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'result' => $result,
            'id' => $model->id
        ]);
    }
    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function getModuleItem($id)
    {
        $model = \app\models\AuthItem::find()
            ->where(['auth_module_id' => $id])
            ->orderBy(['auth_item_name' => SORT_ASC])
            ->asArray()
            ->all();

        return $model;
    }
}
