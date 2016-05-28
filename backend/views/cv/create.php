<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cv */

$this->title = 'Create Cv';
$this->params['breadcrumbs'][] = ['label' => 'Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
