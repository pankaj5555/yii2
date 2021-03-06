<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>
        <div class="box-body">

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Role</h4></div>
                    <div class="panel-body">
                        <div class="class="container-items"">
                            <?php echo $form->field($modelAuthItem, 'name', ['template' => "{label}\n<div class='col-sm-6'>{input}</div>\n{hint}\n{error}",
                                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                        ])->textInput(['maxlength' => true]) ?>

                            <?php echo $form->field($modelAuthItem, 'description', ['template' => "{label}\n<div class='col-sm-6'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->textarea(['rows' => 4,'placeholder'=>'Address']) ?>
                        </div>
                     </div>
                </div>
            </div>

            <div class="col-sm-6">
                 <div class="panel panel-default">
                <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Rights/Permissions</h4></div>
                <div class="panel-body">

                     <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 4, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelAuthItemChild[0],
                        'formId' => 'dynamic-form',
                        'formFields' => ['child',],
                    ]); ?>

                    <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelAuthItemChild as $i => $modelAuthItemChild): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Permissions</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">

                                <?php echo $form->field($modelAuthItemChild, "[{$i}]child", ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                            ])->dropDownList($Auth_Item_Child_Arr, ['prompt' => 'Select Permission','class'=>'form-control select2','style'=>"width: 100%;"])
                                ?>
                                </div>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
            </div>
        </div>

        <div class="form-group col-sm-12 text-center">
            <?php echo Html::submitButton($modelAuthItemChild->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Cancel', ['/auth-item/'], ['class'=>'btn btn-danger']) ?>
        </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php echo $this->registerJs("$('.select2').select2();");?>
