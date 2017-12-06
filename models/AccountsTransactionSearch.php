<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountsTransaction;

/**
 * AccountsTransactionSearch represents the model behind the search form of `app\models\AccountsTransaction`.
 */
class AccountsTransactionSearch extends AccountsTransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_journal', 'fk_account', 'fk_source'], 'integer'],
            [['dr', 'cr', 'running_balance'], 'number'],
            [['details', 'date_created', 'created_by', 'date_modified', 'modified_by'], 'safe'],
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
        $query = AccountsTransaction::find()->orderBy('id desc');

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
            'fk_journal' => $this->fk_journal,
            'fk_account' => $this->fk_account,
            'fk_source' => $this->fk_source,
            'dr' => $this->dr,
            'cr' => $this->cr,
            'running_balance' => $this->running_balance,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
