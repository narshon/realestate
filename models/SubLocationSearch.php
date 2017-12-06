<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubLocation;

/**
 * SubLocationSearch represents the model behind the search form about `app\models\SubLocation`.
 */
class SubLocationSearch extends SubLocation
{
    public $fkLocation;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_location'], 'integer'],
            [['sub_loc_name', 'sub_loc_desc', 'fkLocation'], 'safe'],
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
        $query = SubLocation::find();

        // add conditions that should always apply here
        $query->joinWith(['fkLocation']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkLocation'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_location.location_name' => SORT_ASC],
        'desc' => ['re_location.location_name' => SORT_DESC],
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
            'fk_location' => $this->fk_location,
        ]);

        $query->andFilterWhere(['like', 'sub_loc_name', $this->sub_loc_name])
              ->andFilterWhere(['like', 're_location.location_name', $this->fkLocation])
            ->andFilterWhere(['like', 'sub_loc_desc', $this->sub_loc_desc]);

        return $dataProvider;
    }
}
