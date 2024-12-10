<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property int $id_reserva
 * @property int $id_cliente
 * @property int $num_habitacion
 * @property string $fecha_entrada
 * @property string $fecha_salida
 * @property string $estado
 *
 * @property Clientes $cliente
 * @property Facturas[] $facturas
 * @property Habitaciones $numHabitacion
 */
class Reservas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cliente', 'num_habitacion', 'fecha_entrada', 'fecha_salida', 'estado'], 'required'],
            [['id_cliente', 'num_habitacion'], 'integer'],
            [['fecha_entrada', 'fecha_salida'], 'safe'],
            [['estado'], 'string', 'max' => 1],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['id_cliente' => 'id_cliente']],
            [['num_habitacion'], 'exist', 'skipOnError' => true, 'targetClass' => Habitaciones::class, 'targetAttribute' => ['num_habitacion' => 'num_habitacion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_reserva' => 'Id Reserva',
            'id_cliente' => 'Id Cliente',
            'num_habitacion' => 'Num Habitacion',
            'fecha_entrada' => 'Fecha Entrada',
            'fecha_salida' => 'Fecha Salida',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery|ClientesQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::class, ['id_cliente' => 'id_cliente']);
    }

    /**
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery|FacturasQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Facturas::class, ['id_reserva' => 'id_reserva']);
    }

    /**
     * Gets query for [[NumHabitacion]].
     *
     * @return \yii\db\ActiveQuery|HabitacionesQuery
     */
    public function getNumHabitacion()
    {
        return $this->hasOne(Habitaciones::class, ['num_habitacion' => 'num_habitacion']);
    }

    /**
     * {@inheritdoc}
     * @return ReservasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReservasQuery(get_called_class());
    }
}
