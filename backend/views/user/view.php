<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'nama_depan',
            'nama_belakang',
            'email:email',
            'username',
            'alamat',
            'telp',
            'hp',
            [
                'label' => 'Jenis Kelamin',
                'value' => User::getJenkel($model->jenis_kelamin)
            ],
            [
                'label' => 'Agama',
                'value' => User::getAgama($model->agama)
            ],
            [
                'label' => 'Pict',
                'type' => 'row',
                'format' => ['image', ['width' => '150', 'height' => '100', 'alt' => $model->nama_depan]],
                'value' => !empty($model->pict) ? \Yii::$app->cv->lihatImageDetail($model->pict, "", $kategori = "user") : NULL,
            ],
            'password',
            [
                'label' => 'Status',
                'value' => User::getStatus($model->status)
            ],
        ],
    ]) ?>

</div>
