<?php

namespace app\modules\operator\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\operator\models\Stamps;

/**
 * StampsSearch represents the model behind the search form of `app\modules\operator\models\Stamps`.
 */
class StampsSearch extends Stamps
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['stamp_code', 'stamp_name', 'color','content'], 'safe'],
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
        $query = Stamps::find();

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
        ]);

        $query->andFilterWhere(['like', 'stamp_code', $this->stamp_code])
            ->andFilterWhere(['like', 'stamp_name', $this->stamp_name])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
