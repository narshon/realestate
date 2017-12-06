<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdvertFeature;

/**
 * AdvertFeatureSearch represents the model behind the search form about `app\models\AdvertFeature`.
 */
class AdvertFeatureSearch extends AdvertFeature
{
    public $fkFeature;
    public $fkAdvert;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_advert_id', 'fk_feature_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['feature_narration', 'image1', 'image2', 'image3', 'date_created', 'date_modified', 'fkFeature', 'fkAdvert'], 'safe'],
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
        $query = AdvertFeature::find();

        // add conditions that should always apply here
        $query->joinWith(['fkFeature', 'fkAdvert']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkFeature'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_feature.feature_name' => SORT_ASC],
        'desc' => ['re_feature.feature_name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['fkAdvert'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_advert.advert_name' => SORT_ASC],
        'desc' => ['re_advert.advert_name' => SORT_DESC],
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
            'fk_advert_id' => $this->fk_advert_id,
            'fk_feature_id' => $this->fk_feature_id,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'feature_narration', $this->feature_narration])
            ->andFilterWhere(['like', 'image1', $this->image1])
            ->andFilterWhere(['like', 'image2', $this->image2])
            ->andFilterWhere(['like', 're_feature.feature_name', $this->fkFeature])
            ->andFilterWhere(['like', 're_advert.advert_name', $this->fkAdvert])
            ->andFilterWhere(['like', 'image3', $this->image3]);

        return $dataProvider;
    }
}
