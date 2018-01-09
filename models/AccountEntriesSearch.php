<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountEntries;

/**
 * AccountEntriesSearch represents the model behind the search form about `app\models\AccountEntries`.
 */
class AccountEntriesSearch extends AccountEntries
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_account_chart', 'created_by'], 'integer'],
            [['trasaction_type', 'entry_date', 'created_on'], 'safe'],
            [['amount'], 'number'],
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
        $query = AccountEntries::find();

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
            'fk_account_chart' => $this->fk_account_chart,
            'amount' => $this->amount,
            'entry_date' => $this->entry_date,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'trasaction_type', $this->trasaction_type]);

        return $dataProvider;
    }
}
