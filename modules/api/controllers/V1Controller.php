<?php

namespace app\modules\api\controllers;
use app\models\Admin;
use app\models\Certifications;
use app\models\LoginForm;
use app\models\ProductImages;
use app\models\Products;
use Yii;
use yii\rest\Controller;
use yii\web\Request;



class V1Controller extends Controller
{
    public function init()
    {
        $headers = Yii::$app->response->headers;
        $headers->add("Cache-Control", "no-cache, no-store, must-revalidate");
        $headers->add("Pragma", "no-cache");
        $headers->add("Expires", 0);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => (YII_ENV_PROD) ? ['*', 'http://localhost:4200'] : ['*', 'http://localhost:4200'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'POST', 'PUT'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Request-Headers' => ['X-Wsse', 'Content-Type'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                'Access-Control-Allow-Credentials' => false,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];
        return $behaviors;
    }
    public function beforeAction($action)
    {
        Yii::$app->controller->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionAddProducts(){

    }
    public function actionGetProductListing()
    {
        $product = Products::find()->all();
        if ($product) {
            $productlisting= [];//created an listing array
            foreach ($product as $pt) {
                $product_images = []; //created an image array
                foreach($pt->productImages as $images){
                    $product_images[]=[
                        'product_image_id' => $images->product_image_id,
                        'image' => Yii::$app->urlManager->createAbsoluteUrl('' . $images['image'], 'http'),
                    ];
                }
                $productlisting[] = [
                    'product_id' => $pt->product_id,
                    'image' => $product_images,
                    'name' => $pt->name,
                    'price' => $pt->price,
                    'quantity' => $pt->quantity,
                ];
            }
            return array('status' => true, 'data' => $productlisting);
        } else {
            return array('status' => false, 'data' => 'No Product Found');
        }
    }
    public function actionProductDetails($product_id){
        $product = Products::find()->where(['product_id'=> $product_id ])->one();
//        print_r($product);exit();
        if ($product) {
            $productdetails= [];//created an product details array
                $product_images = []; //created an product image array
                foreach($product->productImages as $images){
                    $product_images[]=[
                        'product_image_id' => $images->product_image_id,
                        'image' => Yii::$app->urlManager->createAbsoluteUrl('' . $images['image'], 'http'),
                    ];
                }
                $productdetails[] = [
                    'product_id' => $product->product_id,
                    'image' => $product_images,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                ];

            return array('status' => true, 'data' => $productdetails);
        } else {
            return array('status' => false, 'data' => 'No Product Found');
        }
    }

    public function actionRegister()
    {
        $request = Yii::$app->request->bodyParams;
        $model = new Admin();
        $model->email = $request['email'];
        $model->password=$request['password'];
        $model->name = $request['name'];
        $model->gender=$request['gender'];
        if ($model->save()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'You are now a member!';
            return $response;
        }
        else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
        }
    }
    public function actionLogin(){
        $params = Yii::$app->request->post(); // request parameter
        $model=\app\models\Admin::find()->where(['email'=>$params['email']])->one();
        if(!empty($model)){
            $validate = Yii::$app->security->validatePassword($params['password'], $model->password);
            if($validate){
                $response['isSuccess'] = 201;
                $response['message'] = 'Login Successfully';
                return $response;
            }else{
                $response['isSuccess'] = 401;
                $response['message'] = 'Invalid Password';
                return $response;
            }
        }else{
            $response['isSuccess'] = 401;
            $response['message'] = 'Invalid Email';
            return $response;
        }
    }
    public function actionGetCertifications($lang = 'en')
    {
//        print_r($lang);exit;
        $student = Certifications::find()
//            ->select(['certification_id','label_en','label_ar','icon_en_image','icon_ar_image'])
            ->where('is_active=1')->all();
//        print_r($student);exit();
        if ($student) {
            $certificates = [];//created an array
            foreach($student as $st){
                $certificates[] = [ //push an array
                    'certification_id' => $st->certification_id,
                    'label' => ($lang == 'en') ? $st->label_en : $st->label_ar,
                    'icon' => Yii::$app->urlManager->createAbsoluteUrl('' . $st->{'icon_' . $lang . '_image'}, 'http'),
                ];
                return array('status' => true, 'data' => $certificates);
            }
        } else {
            return array('status' => false, 'data' => 'No Student Found');
        }
    }
}