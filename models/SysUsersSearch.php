<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysUsers;

/**
 * SysUsersSearch represents the model behind the search form about `app\models\SysUsers`.
 */
class SysUsersSearch extends Users
{
    public $fkGroup;
    public $fkManagement;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_group_id', 'age'], 'integer'],
            [['username', 'pass', 'name1', 'name2', 'name3', 'email', 'phone', 'occupation','employer','address', 'date_added', 'gender', 'color_code', 'icon_id', 'fkGroup','fkManagement'], 'safe'],
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
        $query = Users::find()->orderBy("id desc");

        // add conditions that should always apply here
        $query->joinWith(['fkGroup','fkManagement']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['fkGroup'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_group.group_name' => SORT_ASC],
        'desc' => ['re_group.group_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fkManagement'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_management.management_name' => SORT_ASC],
        'desc' => ['re_management.management_name' => SORT_DESC],
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
            'fk_group_id' => $this->fk_group_id,
            'age' => $this->age,
            'date_added' => $this->date_added,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'name1', $this->name1])
            ->andFilterWhere(['like', 'name2', $this->name2])
            ->andFilterWhere(['like', 'name3', $this->name3])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
			->andFilterWhere(['like', 'occupation', $this->address])
			->andFilterWhere(['like', 'employer', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'color_code', $this->color_code])
            ->andFilterWhere(['like', 'icon_id', $this->icon_id]);
        
        $query->andFilterWhere(['like', 're_group.group_name', $this->fkGroup]);
        $query->andFilterWhere(['like', 're_management.management_name', $this->fkManagement]);

        return $dataProvider;
    }
}
