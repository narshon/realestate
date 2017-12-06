<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Term;

/**
 * TermSearch represents the model behind the search form about `app\models\Term`.
 */
class TermSearch extends Term
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', '_status', 'created_by', 'modified_by'], 'integer'],
            [['term_name', 'term_desc', 'date_created', 'date_modified'], 'safe'],
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
        $query = Term::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
           
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'term_name', $this->term_name])
            ->andFilterWhere(['like', 'term_desc', $this->term_desc]);

        return $dataProvider;
    }
}
