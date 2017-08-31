<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * common\models\UserSearch represents the model behind the search form about `common\models\users`.
 */
 class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'RoleID', 'status', 'IsPrivate', 'lock'], 'integer'],
            [['username', 'fullname', 'Image', 'auth_key', 'access_token', 'password_hash', 'password_reset_token', 'email', 'LastLoginIP', 'created_at', 'updated_at', 'imei', 'UUID'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'RoleID' => $this->RoleID,
            'status' => $this->status,
            'IsPrivate' => $this->IsPrivate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'Image', $this->Image])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'LastLoginIP', $this->LastLoginIP])
            ->andFilterWhere(['like', 'imei', $this->imei])
            ->andFilterWhere(['like', 'UUID', $this->UUID]);

        return $dataProvider;
    }
}
