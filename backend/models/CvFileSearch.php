<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CvFile;

/**
 * CvFileSearch represents the model behind the search form about `backend\models\CvFile`.
 */
class CvFileSearch extends CvFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cv', 'user_create', 'user_update'], 'integer'],
            [['file', 'description', 'create_time', 'update_time', 'title', 'link'], 'safe'],
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
        $query = CvFile::find();

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
            'id_cv' => $this->id_cv,
            'title' => $this->title,
            'link' => $this->link,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'user_create' => $this->user_create,
            'user_update' => $this->user_update,
        ]);

        $query->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
