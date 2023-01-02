<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Certifications;

/**
 * CertificationsSearch represents the model behind the search form of `app\models\Certifications`.
 */
class CertificationsSearch extends Certifications
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['certification_id','is_active'], 'integer'],
            [['label_en', 'label_ar', 'icon_en_image', 'icon_ar_image', 'created_at', 'updated_at'], 'safe'],
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
        $query = Certifications::find();

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
            'certification_id' => $this->certification_id,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'label_en', $this->label_en])
            ->andFilterWhere(['like', 'label_ar', $this->label_ar])
            ->andFilterWhere(['like', 'icon_en_image', $this->icon_en_image])
            ->andFilterWhere(['like', 'icon_ar_image', $this->icon_ar_image]);

        return $dataProvider;
    }
}
