<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountMap;

/**
 * AccountMapSearch represents the model behind the search form about `app\models\AccountMap`.
 */
class AccountMapSearch extends AccountMap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_term', 'fk_account_chart', 'status', 'created_by', 'modified_by'], 'integer'],
            [['transaction_type', 'created_on', 'modified_on'], 'safe'],
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
        $query = AccountMap::find();

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
            'fk_term' => $this->fk_term,
            'fk_account_chart' => $this->fk_account_chart,
            'status' => $this->status,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'modified_on' => $this->modified_on,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'transaction_type', $this->transaction_type]);

        return $dataProvider;
    }
}
