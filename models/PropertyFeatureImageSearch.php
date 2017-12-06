<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PropertyFeatureImage;

/**
 * PropertyFeatureImageSearch represents the model behind the search form about `app\models\PropertyFeatureImage`.
 */
class PropertyFeatureImageSearch extends PropertyFeatureImage
{
    public $fkPropertyFeature;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_property_feature_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['image_url', 'image_title', 'image_caption', 'date_created', 'date_modified', 'fkPropertyFeature'], 'safe'],
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
        $query = PropertyFeatureImage::find();

        // add conditions that should always apply here
        $query->joinWith(['fkPropertyFeature']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkPropertyFeature'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property_feature.fkFeature.feature_name' => SORT_ASC],
        'desc' => ['re_property_feature.fkFeature.feature_name' => SORT_DESC],
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
            'fk_property_feature_id' => $this->fk_property_feature_id,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'image_title', $this->image_title])
            ->andFilterWhere(['like', 're_property_feature.fkFeature.feature_name', $this->fkPropertyFeature])
            ->andFilterWhere(['like', 'image_caption', $this->image_caption]);

        return $dataProvider;
    }
}
