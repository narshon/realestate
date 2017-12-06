<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estate;

/**
 * EstateSearch represents the model behind the search form about `app\models\Estate`.
 */
class EstateSearch extends Estate
{
    public $fkSubLocation;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_sub_location', 'created_by', 'modified_by'], 'integer'],
            [['estate_name', 'estate_desc', 'estate_review', 'estate_media', 'date_created', 'date_modified', 'fkSubLocation'], 'safe'],
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
        $query = Estate::find();

        // add conditions that should always apply here
        $query->joinWith(['fkSubLocation']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkSubLocation'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_sub_location.sub_loc_name' => SORT_ASC],
        'desc' => ['re_sub_location.sub_loc_name' => SORT_DESC],
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
            'fk_sub_location' => $this->fk_sub_location,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
            'created_by' => $this->created_by,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'estate_name', $this->estate_name])
            ->andFilterWhere(['like', 'estate_desc', $this->estate_desc])
            ->andFilterWhere(['like', 'estate_review', $this->estate_review])
            ->andFilterWhere(['like', 're_sub_location.sub_loc_name', $this->fkSubLocation])
            ->andFilterWhere(['like', 'estate_media', $this->estate_media]);

        return $dataProvider;
    }
}
