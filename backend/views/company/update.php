<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Update Company: ' . $model->c_name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c_id, 'url' => ['view', 'id' => $model->c_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-update" style="margin:15px;">

    <div><h3><strong><?php echo  Html::encode($this->title) ?></strong></h3></div>

    <?php echo  $this->render('_form', [
        'modelCompany' => $model,
        'modelBranches' => $modelBranches,
    ]) ?>

</div>
