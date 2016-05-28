<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CvFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cv Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cv File', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_cv',
            'file',
            'type',
            'description:ntext',
            // 'create_time',
            // 'update_time',
            // 'user_create',
            // 'user_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
