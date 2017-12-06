<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TenantPreference;

/**
 * TenantPreferenceSearch represents the model behind the search form about `app\models\TenantPreference`.
 */
class TenantPreferenceSearch extends TenantPreference
{
    public $fkPref;
    public $fkTenant;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_tenant_id', 'fk_pref_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['pref_notes', 'date_created', 'date_modified', 'fkPref', 'fkTenant'], 'safe'],
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
        $query = TenantPreference::find();

        // add conditions that should always apply here
        $query->joinWith(['fkPref', 'fkTenant']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkPref'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_preference.preference_title' => SORT_ASC],
        'desc' => ['re_preference.preference_title' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['fkTenant'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_tenant.fkUser.username' => SORT_ASC],
        'desc' => ['re_tenant.fkUser.username' => SORT_DESC],
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
            'fk_tenant_id' => $this->fk_tenant_id,
            'fk_pref_id' => $this->fk_pref_id,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'pref_notes', $this->pref_notes])
                ->andFilterWhere(['like', 're_tenant.fkUser.username', $this->fkTenant])
                ->andFilterWhere(['like', 're_preference.preference_title', $this->fkPref]);

        return $dataProvider;
    }
}
