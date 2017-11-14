<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\base\Zink;

/**
 * common\models\ZinkSearch represents the model behind the search form about `common\models\base\Zink`.
 */
 class ZinkSearch extends Zink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mode', 'status'], 'integer'],
            [['name', 'tag', 'description'], 'safe'],
            [['width', 'height', 'max_width', 'max_height'], 'number'],
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
        $query = Zink::find();

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
            'mode' => $this->mode,
            'status' => $this->status,
            'width' => $this->width,
            'height' => $this->height,
            'max_width' => $this->max_width,
            'max_height' => $this->max_height,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
