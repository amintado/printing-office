<?php

namespace common\models;

use common\components\functions;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RoleSearch represents the model behind the search form about `common\models\Role`.
 */
class RoleSearch extends Role
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'description', 'RegisterTime'], 'safe'],
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
        $query = Role::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        //if (!$this->validate()) {
        //    // uncomment the following line if you do not want to return any records when validation fails
        //    // $query->where('0=1');
        //    return $dataProvider;
        //}

        $startDate=null;
        $endDate=null;
        if ($this->RegisterTime) {
            $gdate=functions::convertdate($this->RegisterTime, 1);
            $startDate=$gdate.' 00:00:00';
            $endDate=$gdate.' 23:59:59';
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'RegisterTime' => $this->RegisterTime,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['between', 'RegisterTime', $startDate, $endDate]);

        return $dataProvider;
    }
}
