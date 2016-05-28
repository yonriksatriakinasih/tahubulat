<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "wrk_user".
 *
 * @property integer $id
 * @property string $nama_depan
 * @property string $nama_belakang
 * @property string $email
 * @property string $username
 * @property string $alamat
 * @property string $telp
 * @property string $hp
 * @property integer $jenis_kelamin
 * @property integer $agama
 * @property string $pict
 * @property string $password
 * @property integer $status
 * @property string $last_login
 * @property string $password_hash
 * @property string $auth_key
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_create
 * @property integer $user_update
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $retypepass;
    public $newpass;
    
    const STATUS_AKTIF = 10;
    const STATUS_NOT_AKTIF = 0;
    
    public static function tableName()
    {
        return 'wrk_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_depan', 'nama_belakang', 'email', 'alamat', 'telp', 'hp', 'jenis_kelamin', 'agama', 'pict', 'password', 'status'], 'required',  'on'    =>  ['create']],
            [['nama_depan', 'nama_belakang', 'email', 'alamat', 'telp', 'hp', 'jenis_kelamin', 'agama', 'status'], 'required',  'on'    =>  ['update']],
            [['jenis_kelamin', 'agama', 'status', 'user_create', 'user_update'], 'integer'],
            [['last_login', 'create_time', 'update_time'], 'safe'],
            [['nama_depan'], 'string', 'max' => 20],
            [['nama_belakang', 'email', 'username'], 'string', 'max' => 30],
            [['alamat', 'password', 'password_hash', 'pict'], 'string', 'max' => 255],
            [['telp', 'hp'], 'string', 'max' => 15],
            [['retypepass', 'newpass'], 'string', 'on' => 'update'],
            ['retypepass','cekNewpassword', 'skipOnEmpty' => false], // retype password biarkan kosong jika new password nya kosong
            ['retypepass','cekNewpassword','on'   =>  'update'], // retype password wajib di isi jika new password tidak kosong
            ['retypepass', 'compare', 'compareAttribute' => 'newpass', 'message' => 'Password tidak sama dengan di atas', 'on' => 'update'],
            [['auth_key'], 'string', 'max' => 50],
            ['email','email'],
            [['email'],'unique'],
            [['pict'], 'file', 'extensions' => ['jpeg', 'jpg']],
        ];
    }

    public function cekNewpassword($attribute){
        if(!empty($this->newpass) && empty($this->retypepass)){
            $this->addError($attribute, "Ketik ulang password di atas");
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_depan' => 'Nama Depan',
            'nama_belakang' => 'Nama Belakang',
            'email' => 'Email',
            'username' => 'Username',
            'alamat' => 'Alamat',
            'telp' => 'Telp',
            'hp' => 'Hp',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'pict' => 'Pict',
            'password' => 'Password',
            'status' => 'Status',
            'last_login' => 'Last Login',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }
    
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['update_time']
                ],
                'value' => new \yii\db\Expression('NOW()')
            ],
            'blameable' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'user_create',
                'updatedByAttribute' => 'user_update'
            ]
        ];
    }
    
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            if ($this->isNewRecord) { // jika record baru
                $this->password = md5($this->password, $this->password_hash);
            } else { // jika update record
                if(!empty($this->newpass)){
                    $this->password = md5($this->newpass, $this->password_hash);
                }
            }
            $this->auth_key = Yii::$app->security->generateRandomString();
            $this->username = $this->email;
            
            return true;
        } else {
            return false;
        }
    }
    public function getImageFile() {
        $path_general = \Yii::$app->params['pathUpload'];
        $path_upload_image = $path_general . \Yii::$app->params['pathImageUser'];

        Yii::setAlias('@imageupload', $path_upload_image);
        if (!is_dir(Yii::getAlias('@imageupload') . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/')) {
            @mkdir(Yii::getAlias('@imageupload') . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/', 0755, true);
        }

        return !empty($this->pict) ? \Yii::$app->params['pathUpload'] . \Yii::$app->params['pathImageUser'] . $this->pict : NULL;
    }

    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'pict');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file names
//        $this->pict = $image->name;

        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->pict = date('Y/m/d') . '/' . Yii::$app->security->generateRandomString() . ".{$ext}";

        // the uploaded image instance
        return $image;
    }
    
    public static function getStatus($key = '') {
        $status = [
            10 => 'Aktif',
            0 => 'Not Aktif',
        ];

        if ($key !== '')
            return $status[$key];
        else
            return $status;
    }
    
    public static function getAgama($key = '') {
        $agama = [
            1 =>  'Islam',
            2 =>  'Kristen',
            3 =>  'Hindu',
            4 =>  'Budha'
        ];

        if ($key !== '')
            return $agama[$key];
        else
            return $agama;
    }
    
    public static function getJenkel($key = '') {
        $jenkel = [
            1   =>  'Laki - laki',
            0   =>  'Perempuan'
        ];

        if ($key !== '')
            return $jenkel[$key];
        else
            return $jenkel;
    }
}
