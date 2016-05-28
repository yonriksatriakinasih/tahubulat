<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wrk_cv_file".
 *
 * @property integer $id
 * @property integer $id_cv
 * @property string $file
 * @property string $title
 * @property string $link
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_create
 * @property integer $user_update
 */
class CvFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wrk_cv_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cv', 'file', 'type', 'description', 'create_time', 'update_time', 'user_create', 'user_update'], 'required'],
            [['id_cv', 'user_create', 'user_update'], 'integer'],
            [['description'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['file'], 'string', 'max' => 50],
            [['title'], 'string', 'max' =>  150],
            [['link'], 'string'],
            [['link'], 'url'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cv' => 'Id Cv',
            'file' => 'File',
            'title' => 'Title',
            'link' => 'Link',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }
}
