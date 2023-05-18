<?php

namespace app\modules\operator\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\operator\models\Approver;

/**
 * ApproverSearch represents the model behind the search form of `app\modules\operator\models\Approver`.
 */
class ApproverSearch extends Approver
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reviewer_id', 'approve_name', 'approved'], 'integer'],
            [['approve_at', 'approve_comment'], 'safe'],
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
        $query = Approver::find();

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
            'reviewer_id' => $this->reviewer_id,
            'approve_name' => $this->approve_name,
            'approved' => $this->approved,
        ]);

        $query->andFilterWhere(['like', 'approve_at', $this->approve_at])
            ->andFilterWhere(['like', 'approve_comment', $this->approve_comment]);

        return $dataProvider;
    }
}
