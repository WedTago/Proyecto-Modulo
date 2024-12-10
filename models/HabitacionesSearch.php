<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Habitaciones;

/**
 * HabitacionesSearch represents the model behind the search form of `app\models\Habitaciones`.
 */
class HabitacionesSearch extends Habitaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_habitacion', 'disponibilidad'], 'integer'],
            [['tipo'], 'safe'],
            [['precio'], 'number'],
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
        $query = Habitaciones::find();

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
            'num_habitacion' => $this->num_habitacion,
            'precio' => $this->precio,
            'disponibilidad' => $this->disponibilidad,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
