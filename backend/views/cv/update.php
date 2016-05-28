<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cv */

$this->title = 'Update Cv: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cv-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
