<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OccupancyTerm;

/**
 * OccupancyTermSearch represents the model behind the search form about `app\models\OccupancyTerm`.
 */
class OccupancyTermSearch extends OccupancyTerm
{
    public $fkPropertyTerm;
    public $fkOccupancy;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_occupancy_id', 'fk_property_term_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['date_signed', 'date_created', 'date_modified', 'fkOccupancy', 'fkPropertyTerm','value'], 'safe'],
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
        $query = OccupancyTerm::find()->orderBy("id desc");

        // add conditions that should always apply here
        $query->joinWith(['fkPropertyTerm','fkOccupancy']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['fkOccupancy'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_occupancy.fkProperty.property_name' => SORT_ASC],
        'desc' => ['re_occupancy.fkProperty.property_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fkPropertyTerm'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property_term.fkTerm.term_name' => SORT_ASC],
        'desc' => ['re_property_term.fkTerm.term_name' => SORT_DESC],
        ];

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
            'fk_property_term_id' => $this->fk_property_term_id,
            'date_signed' => $this->date_signed,
            '_status' => $this->_status,
            'value' => $this->value,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
            'created_by' => $this->created_by,
            'modified_by' => $this->modified_by,
        ]);
        $query->andFilterWhere(['like', 're_occupancy.fkProperty.property_name', $this->fkOccupancy])
        ->andFilterWhere(['like', 're_property_term.fkTerm.term_name', $this->fkPropertyTerm]);

        return $dataProvider;
    }
}
