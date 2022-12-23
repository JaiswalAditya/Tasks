<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NodeJsDeveloper;

/**
 * NodeJsDeveloperSearch represents the model behind the search form of `app\models\NodeJsDeveloper`.
 */
class NodeJsDeveloperSearch extends NodeJsDeveloper
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'no_of_experience'], 'integer'],
            [['emp_name', 'emp_age', 'language_used', 'framework_used'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = NodeJsDeveloper::find();

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
            'emp_id' => $this->emp_id,
            'no_of_experience' => $this->no_of_experience,
        ]);

        $query->andFilterWhere(['like', 'emp_name', $this->emp_name])
            ->andFilterWhere(['like', 'emp_age', $this->emp_age])
            ->andFilterWhere(['like', 'language_used', $this->language_used])
            ->andFilterWhere(['like', 'framework_used', $this->framework_used]);

        return $dataProvider;
    }
}
