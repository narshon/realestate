<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WardOne;

/**
 * WardOneSearch represents the model behind the search form about `app\models\WardOne`.
 */
class WardOneSearch extends WardOne
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_subcounty'], 'integer'],
            [['ward_name', 'ward_desc', 'ward_lat', 'ward_long'], 'safe'],
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
        $query = WardOne::find();

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
            'fk_subcounty' => $this->fk_subcounty,
        ]);

        $query->andFilterWhere(['like', 'ward_name', $this->ward_name])
            ->andFilterWhere(['like', 'ward_desc', $this->ward_desc])
            ->andFilterWhere(['like', 'ward_lat', $this->ward_lat])
            ->andFilterWhere(['like', 'ward_long', $this->ward_long]);

        return $dataProvider;
    }
}
