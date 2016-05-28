<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KategoriCvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Cvs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-cv-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kategori Cv', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'create_time',
            'update_time',
            // 'user_create',
            // 'user_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
