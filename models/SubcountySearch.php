<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subcounty;

/**
 * SubcountySearch represents the model behind the search form about `app\models\Subcounty`.
 */
class SubcountySearch extends Subcounty
{
    public $fkCounty;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_county'], 'integer'],
            [['subcounty_name', 'subcounty_desc', 'fkCounty'], 'safe'],
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
        $query = Subcounty::find();

        // add conditions that should always apply here
        $query->joinWith(['fkCounty']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkCounty'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_county.county_name' => SORT_ASC],
        'desc' => ['re_county.county_name' => SORT_DESC],
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
            'fk_county' => $this->fk_county,
        ]);

        $query->andFilterWhere(['like', 'subcounty_name', $this->subcounty_name])
                 ->andFilterWhere(['like', 're_county.county_name', $this->fkCounty])
            ->andFilterWhere(['like', 'subcounty_desc', $this->subcounty_desc]);

        return $dataProvider;
    }
}
