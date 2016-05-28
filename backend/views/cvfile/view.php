<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CvFile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cv Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cv',
            'file',
            'type',
            'description:ntext',
            'create_time',
            'update_time',
            'user_create',
            'user_update',
        ],
    ]) ?>

</div>
