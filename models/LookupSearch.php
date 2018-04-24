<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lookup;

/**
 * LookupSearch represents the model behind the search form about `app\models\Lookup`.
 */
class LookupSearch extends Lookup
{
    public $category0;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', '_order', '_status', 'created_by', 'modified_by'], 'integer'],
            [['_key', '_value', 'date_created', 'date_modified', 'category0'], 'safe'],
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
        $query = Lookup::find()->orderBy("id desc");

        // add conditions that should always apply here
        $query->joinWith(['category0']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['category0'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_category.category_name' => SORT_ASC],
        'desc' => ['re_category.category_name' => SORT_DESC],
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
            'category' => $this->category,
            '_order' => $this->_order,
            '_status' => $this->_status,
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
            'modified_by' => $this->modified_by,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', '_key', $this->_key])
            ->andFilterWhere(['like', 're_category.category_name', $this->category0])
            ->andFilterWhere(['like', '_value', $this->_value]);

        return $dataProvider;
    }
}
