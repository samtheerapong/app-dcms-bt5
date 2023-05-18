<?php

namespace app\modules\operator\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\operator\models\Reviewer;
use app\modules\operator\models\Status;
use app\modules\operator\models\Requester;

/**
 * ReviewerSearch represents the model behind the search form of `app\modules\operator\models\Reviewer`.
 */
class ReviewerSearch extends Reviewer
{

    // **************** เพิ่ม  1 ********************
    public $status_id;
    public $document_number;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'requester_id', 'reviewer_name', 'stamps_id', 'points_id', 'approver_at', 'approver_name'], 'integer'],
            [['reviewer_at', 'document_public_at', 'document_ref', 'document_tags', 'reviewer_comment', 'additional_training', 'approver_comment','document_number'], 'safe'],
            [['document_revision', 'document_age'], 'number'],
            [['status_id'], 'integer'], // **************** เพิ่ม  2 ********************
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
        // $query = Reviewer::find();

        // **************** เพิ่ม  3 ********************
        $query = Reviewer::find()->joinWith('requester.status');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // **************** เพิ่ม  4 ********************
        $query->andFilterWhere(['status.id' => $this->status_id]);
        $query->andFilterWhere(['like', 'requester.document_number', $this->document_number]);
        


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'requester_id' => $this->requester_id,
            'reviewer_name' => $this->reviewer_name,
            'document_revision' => $this->document_revision,
            'document_age' => $this->document_age,
            'stamps_id' => $this->stamps_id,
            'points_id' => $this->points_id,
        ]);

        $query->andFilterWhere(['like', 'reviewer_at', $this->reviewer_at])
            ->andFilterWhere(['like', 'document_public_at', $this->document_public_at])
            ->andFilterWhere(['like', 'document_ref', $this->document_ref])
            ->andFilterWhere(['like', 'document_tags', $this->document_tags])
            ->andFilterWhere(['like', 'reviewer_comment', $this->reviewer_comment])
            ->andFilterWhere(['like', 'additional_training', $this->additional_training])
            ->andFilterWhere(['like', 'approver_name', $this->approver_name])
            ->andFilterWhere(['like', 'approver_at', $this->approver_at])
            ->andFilterWhere(['like', 'approver_comment', $this->approver_comment]);

        return $dataProvider;
    }
}
