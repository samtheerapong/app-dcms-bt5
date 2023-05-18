<?php

namespace app\modules\operator\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\operator\models\Points;

/**
 * PointsSearch represents the model behind the search form of `app\modules\operator\models\Points`.
 */
class PointsSearch extends Points
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sub_points'], 'integer'],
            [['point_code', 'point_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Points::find();

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
            'sub_points' => $this->sub_points,
        ]);

        $query->andFilterWhere(['like', 'point_code', $this->point_code])
            ->andFilterWhere(['like', 'point_name', $this->point_name]);

        return $dataProvider;
    }
}
