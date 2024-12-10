<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "habitaciones".
 *
 * @property int $num_habitacion
 * @property string $tipo
 * @property float $precio
 * @property int $disponibilidad
 *
 * @property Reservas[] $reservas
 */
class Habitaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'habitaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_habitacion', 'tipo', 'disponibilidad'], 'required'],
            [['num_habitacion', 'disponibilidad'], 'integer'],
            [['tipo'], 'string'],
            [['precio'], 'number'],
            [['num_habitacion'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'num_habitacion' => 'Num Habitacion',
            'tipo' => 'Tipo',
            'precio' => 'Precio',
            'disponibilidad' => 'Disponibilidad',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery|ReservasQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['num_habitacion' => 'num_habitacion']);
    }

    /**
     * {@inheritdoc}
     * @return HabitacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HabitacionesQuery(get_called_class());
    }
}
