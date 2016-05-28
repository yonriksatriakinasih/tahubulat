<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CvFile */

$this->title = 'Update Cv File: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cv Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cv-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
