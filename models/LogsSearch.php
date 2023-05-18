<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Logs;

/**
 * LogsSearch represents the model behind the search form of `app\models\Logs`.
 */
class LogsSearch extends Logs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'requester_by', 'stamps_id', 'points_id', 'reviewer_by', 'approve_by'], 'integer'],
            [['document_number', 'document_revision', 'document_title', 'requester_at', 'details', 'covenant', 'docs', 'document_age', 'document_public_at', 'document_tags', 'additional_training', 'reviewer_at', 'reviewer_comment', 'approve_at', 'approver_comment'], 'safe'],
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
        $query = Logs::find();

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
            'requester_by' => $this->requester_by,
            'stamps_id' => $this->stamps_id,
            'points_id' => $this->points_id,
            'reviewer_by' => $this->reviewer_by,
            'approve_by' => $this->approve_by,
        ]);

        $query->andFilterWhere(['like', 'document_number', $this->document_number])
            ->andFilterWhere(['like', 'document_revision', $this->document_revision])
            ->andFilterWhere(['like', 'document_title', $this->document_title])
            ->andFilterWhere(['like', 'requester_at', $this->requester_at])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'covenant', $this->covenant])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'document_age', $this->document_age])
            ->andFilterWhere(['like', 'document_public_at', $this->document_public_at])
            ->andFilterWhere(['like', 'document_tags', $this->document_tags])
            ->andFilterWhere(['like', 'additional_training', $this->additional_training])
            ->andFilterWhere(['like', 'reviewer_at', $this->reviewer_at])
            ->andFilterWhere(['like', 'reviewer_comment', $this->reviewer_comment])
            ->andFilterWhere(['like', 'approve_at', $this->approve_at])
            ->andFilterWhere(['like', 'approver_comment', $this->approver_comment]);

        return $dataProvider;
    }
}
