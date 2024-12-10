<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id_cliente
 * @property string|null $rfc
 * @property string $telefono
 * @property string $nombre
 * @property string $apellido1
 * @property string|null $apellido2
 * @property string|null $correo
 *
 * @property Reservas[] $reservas
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono', 'nombre', 'apellido1'], 'required'],
            [['rfc'], 'string', 'max' => 13],
            [['telefono'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 25],
            [['apellido1', 'apellido2'], 'string', 'max' => 15],
            [['correo'], 'string', 'max' => 40],
            [['rfc'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id Cliente',
            'rfc' => 'Rfc',
            'telefono' => 'Telefono',
            'nombre' => 'Nombre',
            'apellido1' => 'Apellido1',
            'apellido2' => 'Apellido2',
            'correo' => 'Correo',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery|ReservasQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['id_cliente' => 'id_cliente']);
    }

    /**
     * {@inheritdoc}
     * @return ClientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientesQuery(get_called_class());
    }
}
