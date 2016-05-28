<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jenis_kelamin', 'agama', 'status', 'user_create', 'user_update'], 'integer'],
            [['nama_depan', 'nama_belakang', 'email', 'username', 'alamat', 'telp', 'hp', 'pict', 'password', 'last_login', 'password_hash', 'auth_key', 'create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'status' => $this->status,
            'last_login' => $this->last_login,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'user_create' => $this->user_create,
            'user_update' => $this->user_update,
        ]);

        $query->andFilterWhere(['like', 'nama_depan', $this->nama_depan])
            ->andFilterWhere(['like', 'nama_belakang', $this->nama_belakang])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'hp', $this->hp])
            ->andFilterWhere(['like', 'pict', $this->pict])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
