<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PropertySublet;

/**
 * PropertySubletSearch represents the model behind the search form about `app\models\PropertySublet`.
 */
class PropertySubletSearch extends PropertySublet
{
    public $fkProperty;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_property_id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['sublet_name', 'sublet_desc', 'date_created', 'date_modified', 'fkProperty'], 'safe'],
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
        $query = PropertySublet::find();

        // add conditions that should always apply here
        $query->joinWith([ 'fkProperty']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['fkProperty'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_property.property_name' => SORT_ASC],
        'desc' => ['re_property.property_name' => SORT_DESC],
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
            're_property_sublet._status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'sublet_name', $this->sublet_name])
             ->andFilterWhere(['like', 're_property.property_name', $this->fkProperty])
            ->andFilterWhere(['like', 'sublet_desc', $this->sublet_desc]);

        return $dataProvider;
    }
}
