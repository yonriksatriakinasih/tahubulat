<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\KategoriCv;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\Cv */
/* @var $form yii\widgets\ActiveForm */
$hidden_date = 'hidden';
$hidden_file = 'hidden';
$hidden_link = 'hidden';
$hidden_value = 'hidden';
if($model->id_kategori_cv == KategoriCv::KATEGORI_PENDIDIKAN ||
   $model->id_kategori_cv == KategoriCv::KATEGORI_PENGALAMAN_KERJA ||
   $model->id_kategori_cv == KategoriCv::KATEGORI_PENGALAMAN_ORGANISASI ||
   $model->id_kategori_cv == KategoriCv::KATEGORI_PRESTASI){
        $hidden_date = '';
}

if($model->id_kategori_cv == KategoriCv::KATEGORI_PORTFOLIO){
        $hidden_file = '';
}

if($model->id_kategori_cv == KategoriCv::KATEGORI_PORTFOLIO){
        $hidden_link = '';
}

if($model->id_kategori_cv == KategoriCv::KATEGORI_KEMAMPUAN){
        $hidden_value = '';
}
?>

<div class="cv-form">

    <?php $form = ActiveForm::begin([
                        'id'    =>  'form-cv',
                        'options' => ['enctype' => 'multipart/form-data'], // important
//                        'enableClientValidation' => false,
//                        'enableAjaxValidation' => true,
//                        'validateOnSubmit'=>true, 
    ]); ?>

    <?= $form->field($model, 'id_kategori_cv')->dropDownList(ArrayHelper::map(KategoriCv::find()->all(), 'id', 'name'),
                                                            ['prompt'   =>  '-- Pilih Kategori --']) ?>

     <?= $form->field($model, 'id_user')->dropDownList(ArrayHelper::map(User::findAll(['status'    =>  User::STATUS_AKTIF]), 'id', 'nama_depan'),
                                                            ['prompt'   =>  '-- Pilih User --']) ?>
    
    <?= $form->field($model, 'name')->textInput() ?>
    
    <div id="<?= Html::getInputId($model, 'value')?>-wrapper" class="<?= $hidden_value; ?>">
        <?= $form->field($model, 'value')->textInput() ?>
    </div>
    
    <div id="<?= Html::getInputId($model, 'link')?>-wrapper" class="<?= $hidden_link; ?>">
        <?= $form->field($model, 'link')->textInput() ?>
    </div>
            
    <div id="<?= Html::getInputId($model, 'file')?>-wrapper" class="<?= $hidden_file; ?>">
        <?=
            $form->field($model, 'file')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'initialPreview' => [
                        !$model->isNewRecord ? (!empty($model->pict) ? Html::img(\Yii::$app->cv->lihatImageDetail($model->pict, "", $kategori = "cv")) : NULL) : null
                    ],
                    'allowedFileExtensions' => ['jpg', 'jpeg'],
                    'showUpload' => false,
                ],
                'pluginEvents'  =>  [

                ]
            ]);
        ?>
    </div>
    
    <div id="<?= Html::getInputId($model, 'start_date')?>-wrapper" class="<?= $hidden_date; ?>">
        <?= $form->field($model, 'start_date')->widget(DatePicker::className(), [
            'options' => ['placeholder' => 'Pilih Tanggal Mulai'],
            'pluginOptions' => [
                'format' => 'yyyy-mm',
                'todayHighlight' => true,
                'minViewMode'   =>1
            ]
        ])
        ?>
    </div>
    
    <div id="<?= Html::getInputId($model, 'end_date')?>-wrapper" class="<?= $hidden_date; ?>">
        <?= $form->field($model, 'end_date')->widget(DatePicker::className(), [
            'options' => ['placeholder' => 'Pilih Tanggal Berakhir'],
            'pluginOptions' => [
                'format' => 'yyyy-mm',
                'todayHighlight' => true,
                'minViewMode'   =>1
            ]
        ])
        ?>
    </div>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$this->registerJs('$(\'#cv-id_kategori_cv\').on(\'change\', function(){
       if(this.value == "1" || this.value == "2" || this.value == "5" || this.value == "6"){ // jika kategori pendidikan atau pengalaman kerja
            $("#'.Html::getInputId($model, 'start_date').'-wrapper").removeClass(\'hidden\');
            $("#'.Html::getInputId($model, 'end_date').'-wrapper").removeClass(\'hidden\');
       }else{
            $("#'.Html::getInputId($model, 'start_date').'-wrapper").addClass(\'hidden\');
            $("#'.Html::getInputId($model, 'end_date').'-wrapper").addClass(\'hidden\');
       };
       
       if(this.value == "3"){ // jika kategori kemampuan
            $("#'.Html::getInputId($model, 'value').'-wrapper").removeClass(\'hidden\');
       }else{
            $("#'.Html::getInputId($model, 'value').'-wrapper").addClass(\'hidden\');
       };
       
       if(this.value == "4"){ // jika kategori portfolio
            $("#'.Html::getInputId($model, 'link').'-wrapper").removeClass(\'hidden\');
            $("#'.Html::getInputId($model, 'file').'-wrapper").removeClass(\'hidden\');
       }else{
            $("#'.Html::getInputId($model, 'link').'-wrapper").addClass(\'hidden\');
            $("#'.Html::getInputId($model, 'file').'-wrapper").addClass(\'hidden\');
       };
       
        
        })');

?>
