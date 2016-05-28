<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CvFile */

$this->title = 'Create Cv File';
$this->params['breadcrumbs'][] = ['label' => 'Cv Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
