<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Disbursements;

/**
 * DisbursementsSearch represents the model behind the search form about `app\models\Disbursements`.
 */
class DisbursementsSearch extends Disbursements
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_occupancy_rent', 'fk_landlord', 'batch_id', 'created_by', '_status'], 'integer'],
            [['amount'], 'number'],
            [['entry_date', 'created_on'], 'safe'],
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
        $query = Disbursements::find();

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
            'fk_occupancy_rent' => $this->fk_occupancy_rent,
            'fk_landlord' => $this->fk_landlord,
            'batch_id' => $this->batch_id,
            'amount' => $this->amount,
            'entry_date' => $this->entry_date,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            '_status' => $this->_status,
        ]);

        return $dataProvider;
    }
}
