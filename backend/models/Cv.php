<?php

namespace backend\models;

use Yii;
use backend\models\KategoriCv;
use yii\web\UploadedFile;

/**
 * This is the model class for table "wrk_cv".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_kategori_cv
 * @property string $name
 * @property string $value
 * @property string $link
 * @property string $file
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_create
 * @property integer $user_update
 */
class Cv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wrk_cv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_kategori_cv', 'name', 'description'], 'required', 'on'    =>  ['create', 'update']],
            [['start_date', 'end_date'], 'required', 'when' => function($model){
                return $model->id_kategori_cv == KategoriCv::KATEGORI_PENDIDIKAN ||
                        $model->id_kategori_cv == KategoriCv::KATEGORI_PENGALAMAN_KERJA || 
                        $model->id_kategori_cv == KategoriCv::KATEGORI_PENGALAMAN_ORGANISASI ||
                        $model->id_kategori_cv == KategoriCv::KATEGORI_PRESTASI;
            },'whenClient'  => "function(attribute, value){
                            return $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_PENDIDIKAN."' ||
                                $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_PENGALAMAN_KERJA."' ||
                                $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_PENGALAMAN_ORGANISASI."' ||
                                $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_PRESTASI."';
                }", 'on'    =>  ['create', 'update']],
            [['value'], 'required', 'when' => function($model){
                return $model->id_kategori_cv == KategoriCv::KATEGORI_KEMAMPUAN;
            },'whenClient'  => "function(attribute, value){
                            return $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_KEMAMPUAN."';
                }", 'on'    =>  ['create', 'update']],   
            [['link', 'file'], 'required', 'when' => function($model){
                return $model->id_kategori_cv == KategoriCv::KATEGORI_PORTFOLIO;
            },'whenClient'  => "function(attribute, value){
                            return $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_PORTFOLIO."';
                }", 'on'    =>  ['create']],
            [['link'], 'required', 'when' => function($model){
                return $model->id_kategori_cv == KategoriCv::KATEGORI_PORTFOLIO;
            },'whenClient'  => "function(attribute, value){
                            return $('#cv-id_kategori_cv').find(\":selected\").val() == '".KategoriCv::KATEGORI_PORTFOLIO."';
                }", 'on'    =>  ['update']], 
            [['id_user', 'id_kategori_cv', 'user_create', 'user_update', 'value'], 'integer'],
            [['start_date', 'end_date', 'create_time', 'update_time'], 'safe'],
            [['description', 'link'], 'string'],
            [['name'], 'string', 'max'   =>  255],
            [['file'], 'string', 'max'   =>  50],
            //start_date, end_date, value, link, file
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'User',
            'id_kategori_cv' => 'Kategori Cv',
            'name' => 'Name',
            'value' => 'Value',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }
    
    public function getUser(){
        return $this->hasOne(User::className(), ['id'   =>  'id_user']);
    }
    
    public function getKategori(){
        return $this->hasOne(KategoriCv::className(), ['id'   =>  'id_kategori_cv']);
    }
    
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            if ($this->isNewRecord) { // jika record baru
                
            } else { // jika update record
                
            }
            
            !empty($this->start_date) ? $this->start_date = $this->start_date.'-00' : NULL;
            !empty($this->end_date) ? $this->end_date = $this->end_date.'-00' : NULL;
            
            return true;
        } else {
            return false;
        }
    }
    
    public function getImageFile() {
        $path_general = \Yii::$app->params['pathUpload'];
        $path_upload_image = $path_general . \Yii::$app->params['pathImageCv'];

        Yii::setAlias('@imageupload', $path_upload_image);
        if (!is_dir(Yii::getAlias('@imageupload') . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/')) {
            @mkdir(Yii::getAlias('@imageupload') . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/', 0755, true);
        }

        return !empty($this->file) ? \Yii::$app->params['pathUpload'] . \Yii::$app->params['pathImageCv'] . $this->file : NULL;
    }

    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'file');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file names
//        $this->pict = $image->name;

        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->file = date('Y/m/d') . '/' . Yii::$app->security->generateRandomString() . ".{$ext}";

        // the uploaded image instance
        return $image;
    }
}
