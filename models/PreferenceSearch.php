<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Preference;

/**
 * PreferenceSearch represents the model behind the search form about `app\models\Preference`.
 */
class PreferenceSearch extends Preference
{
    public $fkFeature;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_feature', '_status', 'created_by', 'modified_by'], 'integer'],
            [['preference_title', 'preference_desc', 'date_created', 'date_modified', 'fkFeature'], 'safe'],
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
        $query = Preference::find();

        // add conditions that should always apply here
        $query->joinWith(['fkFeature']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['fkFeature'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_feature.feature_name' => SORT_ASC],
        'desc' => ['re_feature.feature_name' => SORT_DESC],
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
            'fk_feature' => $this->fk_feature,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'preference_title', $this->preference_title])
            ->andFilterWhere(['like', 'preference_desc', $this->preference_desc]);
        
        $query->andFilterWhere(['like', 're_feature.feature_name', $this->fkFeature]);

        return $dataProvider;
    }
}
