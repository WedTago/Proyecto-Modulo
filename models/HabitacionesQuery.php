<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Habitaciones]].
 *
 * @see Habitaciones
 */
class HabitacionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Habitaciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Habitaciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
