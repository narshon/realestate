<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Journal;

/**
 * JournalSearch represents the model behind the search form of `app\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','transaction_type','fk_user','fk_occupancy_rent','post_status'], 'integer'],
            [['date', 'receipt_invoice_no','account_type','amount', 'cheque_no', 'details', 'transacted_by', 'date_created', 'created_by', 'date_modified', 'modified_by'], 'safe'],
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
        $query = Journal::find()->orderBy("id desc");

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
            'date' => $this->date,
            'fk_occupancy_rent' => $this->fk_occupancy_rent,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'receipt_invoice_no', $this->receipt_invoice_no])
		 ->andFilterWhere(['like', 'account_type', $this->account_type])
                ->andFilterWhere(['like', 'amount', $this->amount])
                ->andFilterWhere(['like', 'post_status', $this->post_status])
		  ->andFilterWhere(['like', 'transaction_type', $this->transaction_type])
            ->andFilterWhere(['like', 'cheque_no', $this->cheque_no])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'transacted_by', $this->transacted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);
        

        return $dataProvider;
    }
}
