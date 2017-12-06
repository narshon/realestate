<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Blog;

/**
 * BlogSearch represents the model behind the search form about `app\models\Blog`.
 */
class BlogSearch extends Blog
{
    public $fkUser;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_user_id', '_status', 'modified_by', 'created_by'], 'integer'],
            [['blog_title', 'blog_post', 'posted_date', 'date_created', 'date_modified', 'fkUser'], 'safe'],
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
        $query = Blog::find();

        // add conditions that should always apply here
        $query->joinWith(['fkUser']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
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
            'posted_date' => $this->posted_date,
            '_status' => $this->_status,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'blog_title', $this->blog_title])
            ->andFilterWhere(['like', 'sys_users.username', $this->fkUser])
            ->andFilterWhere(['like', 'blog_post', $this->blog_post]);

        return $dataProvider;
    }
}
