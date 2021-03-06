<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DepartmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo  $form->field($model, 'dept_id') ?>

    <?php echo  $form->field($model, 'b_id') ?>

    <?php echo  $form->field($model, 'dept_name') ?>

    <?php echo  $form->field($model, 'c_id') ?>

    <?php echo  $form->field($model, 'dept_created_date') ?>

    <?php // echo $form->field($model, 'dtep_status') ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
