<?php

namespace app\modules\api\controllers;
use app\models\Certifications;
use Yii;
use yii\rest\Controller;


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

    public function actionGet(){
        return "OK";
    }
    public function actionGetAdminRecord()
    {

        $student = \app\models\Admin::find()->all();
//        print_r($student);
//        exit();
        if (count($student) > 0) {
            return array('status' => true, 'data' => $student);
        } else {
            return array('status' => false, 'data' => 'No Student Found');
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
//                     $x = ($lang == 'en') ? (['label_en' => $st->label_en]) : (['label_ar' => $st->label_ar]);
//                echo $x;
                    'label' => ($lang == 'en') ? $st->label_en : $st->label_ar,
                    'icon' => Yii::$app->urlManager->createAbsoluteUrl('' . $st->{'icon_' . $lang . '_image'}, 'http'),

//                    'label_en' => $st->label_en,
//                    'label_ar' => $st->label_ar,
//                    'icon_en_image' => Yii::$app->urlManager->createAbsoluteUrl('' . $st->{'icon_' . $lang . '_image'}, 'http'),
//                    'icon_ar_image' => Yii::$app->urlManager->createAbsoluteUrl('' . $st->{'icon_' . $lang . '_image'}, 'http'),
                ];
//                print_r($st);exit();
                return array('status' => true, 'data' => $certificates);
            }
        } else {
            return array('status' => false, 'data' => 'No Student Found');
        }
    }
}