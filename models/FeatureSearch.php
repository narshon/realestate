<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Feature;

/**
 * FeatureSearch represents the model behind the search form about `app\models\Feature`.
 */
class FeatureSearch extends Feature
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'modified_by'], 'integer'],
            [['feature_name', 'feature_desc', 'date_created', 'date_modified'], 'safe'],
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
        $query = Feature::find();

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
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
            'modified_by' => $this->modified_by,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'feature_name', $this->feature_name])
            ->andFilterWhere(['like', 'feature_desc', $this->feature_desc]);

        return $dataProvider;
    }
}
