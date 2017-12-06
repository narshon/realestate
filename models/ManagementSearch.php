<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Management;

/**
 * ManagementSearch represents the model behind the search form about `app\models\Management`.
 */
class ManagementSearch extends Management
{
    public $featuredProperty;
    public $fkUser;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_user_id', 'management_type', 'featured_property', 'created_by', 'modified_by', '_status'], 'integer'],
            [['location', 'address', 'profile_desc', 'date_created', 'date_modified', 'management_name', 'featuredProperty', 'fkUser'], 'safe'],
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
        $query = Management::find();

        // add conditions that should always apply here
        $query->joinWith(['featuredProperty', 'fkUser']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['featuredProperty'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property.property_name' => SORT_ASC],
        'desc' => ['re_property.property_name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['fkUser'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['sys_users.username' => SORT_ASC],
        'desc' => ['sys_users.username' => SORT_DESC],
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
            'fk_user_id' => $this->fk_user_id,
            'management_name' => $this->management_name,
            'management_type' => $this->management_type,
            'featured_property' => $this->featured_property,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
            '_status' => $this->_status,
        ]);

        $query->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 're_property.property_name', $this->featuredProperty])
            ->andFilterWhere(['like', 'sys_users.username_', $this->fkUser])
            ->andFilterWhere(['like', 'profile_desc', $this->profile_desc]);

        return $dataProvider;
    }
}
