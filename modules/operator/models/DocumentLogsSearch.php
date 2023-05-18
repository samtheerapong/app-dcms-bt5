<?php

namespace app\modules\operator\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\operator\models\DocumentLogs;

/**
 * DocumentLogsSearch represents the model behind the search form of `app\modules\operator\models\DocumentLogs`.
 */
class DocumentLogsSearch extends DocumentLogs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'requester_id', 'reviewer_id'], 'integer'],
            [['created_at', 'updated_at', 'document_name', 'document_revision', 'document_fullname'], 'safe'],
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
        $query = DocumentLogs::find();

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
            'requester_id' => $this->requester_id,
            'reviewer_id' => $this->reviewer_id,
        ]);

        $query->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'document_name', $this->document_name])
            ->andFilterWhere(['like', 'document_revision', $this->document_revision])
            ->andFilterWhere(['like', 'document_fullname', $this->document_fullname]);

        return $dataProvider;
    }
}
