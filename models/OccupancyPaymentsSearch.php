<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OccupancyPayments;

/**
 * OccupancyPaymentsSearch represents the model behind the search form about `app\models\OccupancyPayments`.
 */
class OccupancyPaymentsSearch extends OccupancyPayments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_occupancy_id', 'fk_receipt_id', 'payment_method', 'status', 'created_by', 'modified_by'], 'integer'],
            [['amount'], 'number'],
            [['payment_date', 'ref_no', 'created_on', 'modified_on'], 'safe'],
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
        $query = OccupancyPayments::find()->orderBy("id desc");

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
            'fk_occupancy_id' => $this->fk_occupancy_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'fk_receipt_id' => $this->fk_receipt_id,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'ref_no', $this->ref_no]);

        return $dataProvider;
    }
}
