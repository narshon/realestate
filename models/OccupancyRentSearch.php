<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OccupancyRent;

/**
 * OccupancyRentSearch represents the model behind the search form about `app\models\OccupancyRent`.
 */
class OccupancyRentSearch extends OccupancyRent
{
    public $fkOccupancy;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_occupancy_id', 'fk_source', 'month', 'year', '_status', 'created_by', 'modified_by'], 'integer'],
            [['date_created', 'date_modified', 'fkOccupancy'], 'safe'],
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
        $query = OccupancyRent::find()->orderBy("id desc");

        // add conditions that should always apply here
        $query->joinWith(['fkOccupancy','fkSource']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['fkOccupancy'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_occupancy.fkProperty.property_name' => SORT_ASC],
        'desc' => ['re_occupancy.fkProperty.property_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fkSource'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_source.fkSource.source_name' => SORT_ASC],
        'desc' => ['re_source.fkSource.source_name' => SORT_DESC],
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
            'month' => $this->month,
            'year' => $this->year,
            'fk_source' => $this->fk_source,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);
        
        $query->andFilterWhere(['like', 're_occupancy.fkProperty.property_name', $this->fkOccupancy]);
        $query->andFilterWhere(['like', 're_source.fkSource.source_name', $this->fkSource]);

        return $dataProvider;
    }
}
