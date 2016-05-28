<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cv;

/**
 * CvSearch represents the model behind the search form about `backend\models\Cv`.
 */
class CvSearch extends Cv
{
    /**
     * @inheritdoc
     */
    public $user;
    public $kategori;
    
    public function rules()
    {
        return [
            [['id', 'id_kategori_cv', 'user_create', 'user_update', 'value'], 'integer'],
            [['user', 'kategori', 'start_date', 'end_date', 'description', 'create_time', 'update_time', 'name', 'link', 'file'], 'safe'],
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
        // referensi http://www.yiiframework.com/wiki/653/displaying-sorting-and-filtering-model-relations-on-a-gridview/
        
        $query = Cv::find();
        $query->joinWith(['user', 'kategori']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['user'] = [
            'asc'   =>  ['wrk_user.email'   =>  SORT_ASC],
            'desc'   =>  ['wrk_user.email'   =>  SORT_DESC]
        ];
        
        $dataProvider->sort->attributes['kategori'] = [
            'asc'   =>  ['wrk_kategori_cv.name'   =>  SORT_ASC],
            'desc'   =>  ['wrk_kategori_cv.name'   =>  SORT_DESC]
        ];
        
        if(!($this->load($params) && $this->validate())){
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        };

        // grid filtering conditions
        $query->andFilterWhere([
            'wrk_cv.id' => $this->id,
            'id_user' => $this->id_user,
            'id_kategori_cv' => $this->id_kategori_cv,
            'name' => $this->name,
            'value' => $this->value,
            'link' => $this->link,
            'file' => $this->file,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'user_create' => $this->user_create,
            'user_update' => $this->user_update,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', 'wrk_user.email', $this->user]);
        $query->andFilterWhere(['like', 'wrk_kategori_cv.name', $this->kategori]);

        return $dataProvider;
    }
}
