<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KategoriCv */

$this->title = 'Create Kategori Cv';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-cv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
