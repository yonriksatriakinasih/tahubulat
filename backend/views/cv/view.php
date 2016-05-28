<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Cv */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-view">

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
            [
                'label' => 'User',
                'value' => backend\models\User::findOne(['id'   =>  $model->id_user])->nama_depan
            ],
            [
                'label' => 'Kategori',
                'value' => backend\models\KategoriCv::findOne(['id'   =>  $model->id_kategori_cv])->name
            ],
            'link',
            [
                'label' => 'File',
                'type' => 'row',
                'format' => ['image', ['width' => '150', 'height' => '100', 'alt' => $model->name]],
                'value' => !empty($model->file) ? \Yii::$app->cv->lihatImageDetail($model->file, "", $kategori = "cv") : NULL,
            ],
            'value',
            'start_date',
            'end_date',
            'description:ntext',
        ],
    ]) ?>

</div>
