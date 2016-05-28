<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id'    =>  'form-user',
                    'options' => ['enctype' => 'multipart/form-data'], // important
    ]); ?>

    <?= $form->field($model, 'nama_depan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_belakang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'password')->textInput() ?>
    <?php else: ?>
        <?= $form->field($model, 'newpass')->textInput() ?>
        <?= $form->field($model, 'retypepass')->textInput() ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'alamat')->textarea([]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList(User::getJenkel(),
                                                             ['prompt'  =>  '-- Pilih Jenis Kelamin --']) ?>

    <?= $form->field($model, 'agama')->dropDownList(User::getAgama(),
                                                    ['prompt'    =>  '-- Pilih Agama --']) ?>

    <?=
    $form->field($model, 'pict')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'initialPreview' => [
                !$model->isNewRecord ? (!empty($model->pict) ? Html::img(\Yii::$app->cv->lihatImageDetail($model->pict, "", $kategori = "user")) : NULL) : null
            ],
            'allowedFileExtensions' => ['jpg', 'jpeg'],
            'showUpload' => false,
        ],
        'pluginEvents'  =>  [
            
        ]
    ]);
    ?>
    

    <?= $form->field($model, 'status')->dropDownList(User::getStatus(),['prompt'   =>  '-- Pilih Status --']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
