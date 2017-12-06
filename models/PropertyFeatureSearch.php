<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PropertyFeature;

/**
 * PropertyFeatureSearch represents the model behind the search form about `app\models\PropertyFeature`.
 */
class PropertyFeatureSearch extends PropertyFeature
{
    public $fkFeature;
    public $fkProperty;
    public $fkSublet;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_feature', 'fk_property_id', 'fk_sublet_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['feature_narration', 'feature_video_url', 'date_created', 'date_modified', 'fkFeature', 'fkProperty', 'fkSublet'], 'safe'],
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
        $query = PropertyFeature::find();

        // add conditions that should always apply here
        $query->joinWith(['fkFeature', 'fkProperty', 'fkSublet']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['fkFeature'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_feature.feature_name' => SORT_ASC],
        'desc' => ['re_feature.feature_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fkProperty'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property.property_name' => SORT_ASC],
        'desc' => ['re_property.property_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fkSublet'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property_sublet.sublet_name' => SORT_ASC],
        'desc' => ['re_property_sublet.sublet_name' => SORT_DESC],
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
            'fk_property_id' => $this->fk_property_id,
            'fk_sublet_id' => $this->fk_sublet_id,
            're_property_feature._status' => $this->_status,
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
            'modified_by' => $this->modified_by,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'feature_narration', $this->feature_narration])
            ->andFilterWhere(['like', 're_feature.feature_name', $this->fkFeature])
           ->andFilterWhere(['like', 're_property.property_name', $this->fkProperty])
           ->andFilterWhere(['like', 're_property_sublet.sublet_name', $this->fkSublet])
            ->andFilterWhere(['like', 'feature_video_url', $this->feature_video_url]);

        return $dataProvider;
    }
}
