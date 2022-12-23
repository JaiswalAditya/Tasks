<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\helpers\BaseUrl;
use yii\bootstrap4\BootstrapAsset;
/* @var yii\web\View $this /    
/* @var app\models\Admin $model /
/* @var yii\widgets\ActiveForm $form /

/**
 * AdminController implements the CRUD actions for Admin model.
 */
AppAsset::register($this);
 $this->registerJsFile(BaseUrl::home() . 'js/permission.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/** @var yii\web\View $this */
/** @var app\models\Admin $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(
       ['...','Male' => 'Male', 'Female' => 'Female', 'Others' => 'Others']
    ); 
    ?>

    <br/>
    <div class="col-md-12">
                <?php $checkAll = 0; ?>


                <h4>Admin Permissions</h4>
                <hr>


                <?php

                $checkAll = 1;
                if (!empty($result)) {
                    foreach ($result as $row) {
                        $countModuleRole = \app\helpers\PermissionHelper::countUserModuleRole($id, $row['auth_module_id'], 'A');
                        if (sizeof($row['items']) == $countModuleRole) {
                            $checkAll = 1;
                        }
                    }
                }
                ?>
                <ul class="tree-make">
                    <input class="i-checks pIcheck" <?php echo ($checkAll == 0) ? '' : 'checked="checked"' ?> id="check-all" type="checkbox" onclick="permission.togglePermission()" /> <label>Select all</label>
                    <br>
                    <?php

                    if (!empty($result)) {
                        foreach ($result as $row) {

                            $countModuleRole = \app\helpers\PermissionHelper::countUserModuleRole($id, $row['auth_module_id'], 'A');
                            $checkAll = 0;
                            if (sizeof($row['items']) == $countModuleRole) {
                                $checkAll = 1;
                            }
                    ?>

                            <li style="list-style-type: none;">
                                <div class="mcollapse" id="module<?php echo $row['auth_module_id']; ?>">
                                    <input class="i-checks mIcheck" <?php echo ($checkAll == 0) ? '' : 'checked="checked"' ?> id="chk<?php echo $row['auth_module_id']; ?>" type="checkbox" name="module_list[]" value="<?php echo $row['auth_module_id']; ?>" onclick="permission.checkUncheckCheckbox(<?php echo $row['auth_module_id']; ?>)" />
                                    <a style="width: 96%;" class="pull" onclick="permission.showHideTreeNode(this,<?php echo $row['auth_module_id']; ?>)" href="javascript:;"> <span class="pull" style="margin: 4px 5px 8px 5px;;display: inline-block"><b><?php echo $row['auth_module_name']; ?></b></span>
                                        <i class="fa fa-plus-square fa-2x float-right"></i>
                                    </a>

                                    <ul class="tree-engine" id="tree-engine-194" style="display:none">
                                        <?php
                                        if (!empty($row['items'])) {
                                        ?>
                                            <div class="checkbox no-top-padding">
                                                <ul style="margin: 0px;padding: 0px;">
                                                    <?php
                                                    foreach ($row['items'] as $itm) {
                                                        $hasRole = \app\helpers\PermissionHelper::checkUserHasRole($id, $itm['auth_item_id'], 'A');
                                                    ?>
                                                        <li class="chk">
                                                            <input class="i-checks iIcheck" <?php echo ($hasRole == 0) ? '' : 'checked="checked"' ?> id="itemChk<?php echo $itm['auth_item_id']; ?>" data-module_id="<?php echo $row['auth_module_id']; ?>" type="checkbox" name="item_list[]" value="<?php echo $itm['auth_item_id']; ?>" onclick="permission.checkUncheckItemCheckbox(<?php echo $row['auth_module_id']; ?>,<?php echo $itm['auth_item_id']; ?>)" />
                                                            <span class="pull" style="margin: 1px 0px 0 10px;position: absolute"><?php echo $itm['auth_item_name']; ?></span>
                                                        </li>
                                                        <!--<br clear="all"/>-->
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
