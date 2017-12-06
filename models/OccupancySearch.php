<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Occupancy;

/**
 * OccupancySearch represents the model behind the search form about `app\models\Occupancy`.
 */
class OccupancySearch extends Occupancy
{
    public $fkTenant;
    public $fkProperty;
    public $fkSublet;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_property_id', 'fk_sublet_id', 'fk_tenant_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['start_date', 'end_date', 'notes', 'date_created', 'date_modified', 'fkTenant', 'fkProperty', 'fkSublet'], 'safe'],
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
        $query = Occupancy::find();

        // add conditions that should always apply here
        $query->joinWith(['fkTenant', 'fkProperty', 'fkSublet']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkTenant'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_tenant.sysusers.username' => SORT_ASC],
        'desc' => ['re_tenant.sysusers.username' => SORT_DESC],
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
        'asc' => ['re_sublet.sublet_name' => SORT_ASC],
        'desc' => ['re_sublet.sublet_name' => SORT_DESC],
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
            'fk_property_id' => $this->fk_property_id,
            'fk_sublet_id' => $this->fk_sublet_id,
            'fk_tenant_id' => $this->fk_tenant_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 're_tenant.sysusers.username', $this->fkTenant])
                ->andFilterWhere(['like', 're_property.property_name', $this->fkProperty])
                ->andFilterWhere(['like', 're_sublet.sublet_name', $this->fkSublet]);

        return $dataProvider;
    }
}
