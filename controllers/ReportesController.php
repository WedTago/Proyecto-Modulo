<?php
namespace app\controllers;
use yii;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReporte1()
    {
        $id_reserva = Yii::$app->request->get('id_reserva');

        // Construye la consulta SQL base
        $sql = "SELECT C.nombre, C.apellido1, C.apellido2, SUM(H.precio*(DATEDIFF(R.fecha_salida,R.fecha_entrada))) AS 'CostoTotal'
                FROM reservas R
                INNER JOIN clientes C
                ON R.id_cliente = C.id_cliente
                INNER JOIN habitaciones H
                ON H.num_habitacion = R.num_habitacion
                WHERE 1=1";
                // Esta linea siempre es verdadera y permite agregar and de forma dinamica
        // Agrega condiciones de filtro dinámicamente si son mandados
        $params = [];
        if ($id_reserva) {// Si el parametro trae un valor
            $sql .= " AND R.id_reserva = :id_reserva";
            $params[':id_reserva'] = $id_reserva;
        }
        // Ejecuta la consulta
        $reservas = Yii::$app->db->createCommand($sql, $params)->queryAll();

        //Mandamos a la vista el conjunto de registros retornados en la variable $empleados
        return $this->render('reporte1', [
            'reservas' => $reservas,
        ]);
        return $this->render('reporte1');
    }

    public function actionReporte2()
    {
        $fecha_entrada = Yii::$app->request->get('fecha_entrada');
        $fecha_salida = Yii::$app->request->get('fecha_salida');

        $sql = "SELECT H.habitacion_numero AS 'disponible'
            FROM habitaciones H
            WHERE NOT EXISTS (
            SELECT NULL
            FROM reservas R
        WHERE ";

        $params = [];
        if ($fecha_entrada) {// Si el parametro trae un valor
            $sql .= " AND :fecha_entrada <= :fecha_salida";
            $params[':fecha_entrada'] = $fecha_entrada;
            $params[':fecha_salida'] = $fecha_entrada;
        }

        $params = [];
        if ($fecha_salida) {// Si el parametro trae un valor
            $sql .= " AND :fecha_salida >= :fecha_entrada)";
            $params[':fecha_entrada'] = $fecha_entrada;
            $params[':fecha_salida'] = $fecha_entrada;
        }

        $sql .= " ORDER BY .num_habitacion";

        $fechas = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('reporte2', [
            'fechas' => $fechas,
        ]);
        return $this->render('reporte2');
    }

    public function actionReporte3()
    {
        return $this->render('reporte3');
    }

}
