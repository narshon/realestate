<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ward;

/**
 * WardSearch represents the model behind the search form about `app\models\Ward`.
 */
class WardSearch extends Ward
{
    public $fkSubcounty;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_subcounty'], 'integer'],
            [['ward_name', 'ward_desc', 'fkSubcounty'], 'safe'],
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
        $query = Ward::find();

        // add conditions that should always apply here
        $query->joinWith(['fkSubcounty']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['fkSubcounty'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_subcounty.subcounty_name' => SORT_ASC],
        'desc' => ['re_subcounty.subcounty_name' => SORT_DESC],
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
            'fk_subcounty' => $this->fk_subcounty,
        ]);

        $query->andFilterWhere(['like', 'ward_name', $this->ward_name])
                ->andFilterWhere(['like', 're_subcounty.subcounty_name', $this->fkSubcounty])
            ->andFilterWhere(['like', 'ward_desc', $this->ward_desc]);

        return $dataProvider;
    }
}
