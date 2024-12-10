<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturas".
 *
 * @property int $id_factura
 * @property int $id_reserva
 * @property int $estatus_pago
 * @property string $descripcion
 * @property string $fecha_factura
 *
 * @property Reservas $reserva
 */
class Facturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_reserva', 'estatus_pago', 'descripcion', 'fecha_factura'], 'required'],
            [['id_reserva', 'estatus_pago'], 'integer'],
            [['fecha_factura'], 'safe'],
            [['descripcion'], 'string', 'max' => 100],
            [['id_reserva'], 'exist', 'skipOnError' => true, 'targetClass' => Reservas::class, 'targetAttribute' => ['id_reserva' => 'id_reserva']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_factura' => 'Id Factura',
            'id_reserva' => 'Id Reserva',
            'estatus_pago' => 'Estatus Pago',
            'descripcion' => 'Descripcion',
            'fecha_factura' => 'Fecha Factura',
        ];
    }

    /**
     * Gets query for [[Reserva]].
     *
     * @return \yii\db\ActiveQuery|ReservasQuery
     */
    public function getReserva()
    {
        return $this->hasOne(Reservas::class, ['id_reserva' => 'id_reserva']);
    }

    /**
     * {@inheritdoc}
     * @return FacturasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacturasQuery(get_called_class());
    }
}
