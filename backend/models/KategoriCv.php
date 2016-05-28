<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wrk_kategori_cv".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_create
 * @property integer $user_update
 */
class KategoriCv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const KATEGORI_PENDIDIKAN = 1;
    const KATEGORI_PENGALAMAN_KERJA = 2;
    const KATEGORI_KEMAMPUAN = 3;
    const KATEGORI_PORTFOLIO = 4;
    const KATEGORI_PENGALAMAN_ORGANISASI = 5;
    const KATEGORI_PRESTASI = 6;
    
    public static function tableName()
    {
        return 'wrk_kategori_cv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['user_create', 'user_update'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
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
                    \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE => 'update_time'
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
}
