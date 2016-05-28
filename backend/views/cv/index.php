<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cvs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cv', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'User',
                'attribute' => 'user',
                'value' => 'user.email',
            ],
            [
                'label' => 'Kategori',
                'attribute' => 'kategori',
                'value' => 'kategori.name',
            ],
//            'start_date',
//            'end_date',
             'description:ntext',
            // 'create_time',
            // 'update_time',
            // 'user_create',
            // 'user_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
