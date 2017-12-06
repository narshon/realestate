<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PropertyArea;

/**
 * PropertyAreaSearch represents the model behind the search form about `app\models\PropertyArea`.
 */
class PropertyAreaSearch extends PropertyArea
{
    
    public $subLocation;
    public $property;
    public $estate;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_property_id', 'fk_sub_location_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['area_desc', 'date_created', 'date_modified', 'area_name','property','subLocation','estate'], 'safe'],
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
        $query = PropertyArea::find();

        // add conditions that should always apply here
        $query->joinWith(['property','subLocation','estate']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['property'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property.property_name' => SORT_ASC],
        'desc' => ['re_property.property_name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['subLocation'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_sub_location.sub_loc_name' => SORT_ASC],
        'desc' => ['re_sub_location.sub_loc_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['estate'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_estate.estate_name' => SORT_ASC],
        'desc' => ['re_estate.estate_name' => SORT_DESC],
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
            'fk_property_id' => $this->fk_property_id,
            'fk_sub_location_id' => $this->fk_sub_location_id,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
            'created_by' => $this->created_by,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'area_desc', $this->area_desc])
            ->andFilterWhere(['like', 'area_name', $this->area_name])
            ->andFilterWhere(['like', 're_property.property_name', $this->property])
            ->andFilterWhere(['like', 're_sub_location.sub_loc_name', $this->subLocation])
            ->andFilterWhere(['like', 're_estate.estate_name', $this->estate]);

        return $dataProvider;
    }
}
