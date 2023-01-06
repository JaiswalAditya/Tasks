<?php
/** @var \app\models\Admin $model */
use yii\helpers\BaseUrl;

//use yii\web\Request;
//$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
//echo print_r(Yii::$app->urlManager->createAbsoluteUrl('uploads/' . $model->logo, 'http'));exit;
$path = Yii::$app->urlManager->createAbsoluteUrl('uploads/' . $model->logo);

?>
<div>
    <div>
        <h1>Generating PDF of Admin</h1>
    </div>
    <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Department</td>
            <td>logo</td>
            <td>products</td>
            <td>gender</td>
        </tr>
        <tr>
            <td><?php echo $model->id; ?></td>
            <td><?php echo $model->name; ?></td>
            <td><?php echo $model->email; ?></td>
            <td><?php echo $model->department; ?></td>
            <td><img src="var:myvariable" width="200" height="200"/></td>

        </tr>
    </table>
</div>
