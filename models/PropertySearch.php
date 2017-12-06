<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Property;

/**
 * PropertySearch represents the model behind the search form about `app\models\Property`.
 */
class PropertySearch extends Property
{
    public $management;
    public $owner;
    public $propertyType;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property_type', 'management_id', 'owner_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['property_name', 'property_desc', 'management_id', 'owner_id', '_status', 'property_location', 'property_video_url', 'management','owner','propertyType'], 'safe'],
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
        $query = Property::find();

        // add conditions that should always apply here
        $query->joinWith(['management']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['management'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_management.profile_desc' => SORT_ASC],
        'desc' => ['re_management.profile_desc' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['owner'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_management.profile_desc' => SORT_ASC],
        'desc' => ['re_management.profile_desc' => SORT_DESC],
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
            'property_type' => $this->property_type,
            //'management_id' => $this->management_id,
            //'owner_id' => $this->owner_id,
            're_property._status' => $this->_status,
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
            'modified_by' => $this->modified_by,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'property_name', $this->property_name])
            ->andFilterWhere(['like', 'property_desc', $this->property_desc])
            ->andFilterWhere(['like', 'property_location', $this->property_location])
            ->andFilterWhere(['like', 're_management.profile_desc', $this->management])
            ->andFilterWhere(['like', 're_management.profile_desc', $this->owner])
            ->andFilterWhere(['like', 'property_video_url', $this->property_video_url]);

        return $dataProvider;
    }
}
