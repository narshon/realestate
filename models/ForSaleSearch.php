<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Advert;

/**
 * AdvertSearch represents the model behind the search form about `app\models\Advert`.
 */
class ForSaleSearch extends ForSale
{
    public $advertOwner;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'advert_owner_id', '_status', 'advert_fee', 'created_by', 'modified_by'], 'integer'],
            [['advert_name', 'advert_desc', 'start_date', 'end_date', 'image1', 'image2', 'image3', 'image4', 'image5', 'contact_details', 'date_created', 'date_modified','advertOwner'], 'safe'],
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
        $query = ForSale::find();

        // add conditions that should always apply here
        $query->joinWith(['advertOwner']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['advertOwner'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['re_management.property_name' => SORT_ASC],
        'desc' => ['re_management.property_name' => SORT_DESC],
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
            'advert_owner_id' => $this->advert_owner_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            '_status' => $this->_status,
            'advert_fee' => $this->advert_fee,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'date_modified' => $this->date_modified,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'advert_name', $this->advert_name])
            ->andFilterWhere(['like', 'advert_desc', $this->advert_desc])
            ->andFilterWhere(['like', 'image1', $this->image1])
            ->andFilterWhere(['like', 'image2', $this->image2])
            ->andFilterWhere(['like', 'image3', $this->image3])
            ->andFilterWhere(['like', 'image4', $this->image4])
            ->andFilterWhere(['like', 'image5', $this->image5])
            ->andFilterWhere(['like', 're_management.management_name', $this->advertOwner])
            ->andFilterWhere(['like', 'contact_details', $this->contact_details]);

        return $dataProvider;
    }
}
