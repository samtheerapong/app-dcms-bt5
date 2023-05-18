<?php

namespace app\modules\operator\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\operator\models\Requester;

/**
 * RequesterSearch represents the model behind the search form of `app\modules\operator\models\Requester`.
 */
class RequesterSearch extends Requester
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'types_id', 'status_id', 'created_by', 'updated_by', 'request_by', 'categories_id', 'departments_id'], 'integer'],
            [['document_title', 'details', 'covenant', 'docs', 'ref', 'fullname', 'created_at', 'document_number', 'updated_at'], 'safe'],
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
        $query = Requester::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'types_id' => $this->types_id,
            'status_id' => $this->status_id,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'request_by' => $this->request_by,
            'categories_id' => $this->categories_id,
            'departments_id' => $this->departments_id,
        ]);

        $query->andFilterWhere(['like', 'document_title', $this->document_title])
            ->andFilterWhere(['like', 'document_number', $this->document_number])
            // ->andFilterWhere(['like', "(date_format( FROM_UNIXTIME(`created_at` ), '%d-%m-%Y %h:%i:%s %p' ))", $this->created_at])
            // ->andFilterWhere(['like', "(date_format( FROM_UNIXTIME(`updated_at` ), '%d-%m-%Y %h:%i:%s %p' ))", $this->updated_at])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'covenant', $this->covenant])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        return $dataProvider;
    }
}
