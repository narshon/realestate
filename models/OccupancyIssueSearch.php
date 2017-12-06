<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OccupancyIssue;

/**
 * OccupancyIssueSearch represents the model behind the search form about `app\models\OccupancyIssue`.
 */
class OccupancyIssueSearch extends OccupancyIssue
{
    public $fkRelatedTerm;
    public $fkOccupancy;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_occupancy_id', 'fk_related_term', 'issue_type', '_status', 'created_by', 'modified_by'], 'integer'],
            [['title', 'desc', 'status_remarks', 'date_created', 'date_modified','fkRelatedTerm','fkOccupancy'], 'safe'],
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
        $query = OccupancyIssue::find();

        // add conditions that should always apply here
        $query->joinWith(['fkRelatedTerm', 'fkOccupancy']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkRelatedTerm'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_occupancy_term.fkPropertyTerm.fkTerm.term_name' => SORT_ASC],
        'desc' => ['re_occupancy_term.fkPropertyTerm.fkTerm.term_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fkOccupancy'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_occupancy.fkProperty.property_name' => SORT_ASC],
        'desc' => ['re_occupancy.fkProperty.property_name' => SORT_DESC],
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
            'fk_occupancy_id' => $this->fk_occupancy_id,
            'fk_related_term' => $this->fk_related_term,
            'issue_type' => $this->issue_type,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 're_occupancy_term.fkPropertyTerm.fkTerm.term_name', $this->fkRelatedTerm])
            ->andFilterWhere(['like', 're_occupancy.fkProperty.property_name', $this->fkOccupancy])
            ->andFilterWhere(['like', 'status_remarks', $this->status_remarks]);

        return $dataProvider;
    }
}
