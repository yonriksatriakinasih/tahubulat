<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_depan',
            'nama_belakang',
            'email:email',
            'username',
            // 'alamat',
            // 'telp',
            // 'hp',
            // 'jenis_kelamin',
            // 'agama',
            // 'pict',
            // 'password',
            // 'status',
            // 'last_login',
            // 'password_hash',
            // 'auth_key',
            // 'create_time',
            // 'update_time',
            // 'user_create',
            // 'user_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
