<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;

class ReportesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Reporte 1: Calcula el costo total de las reservaciones por cliente
     */
    public function actionReporte1()
    {
        $id_reserva = Yii::$app->request->get('id_reserva');

        // Construye la consulta SQL base
        $sql = "SELECT 
                    C.nombre,
                    C.apellido1,
                    C.apellido2,
                    R.id_reserva,
                    R.fecha_entrada,
                    R.fecha_salida,
                    H.tipo as tipo_habitacion,
                    CAST(H.precio AS DECIMAL(10,2)) as precio_por_noche,
                    DATEDIFF(R.fecha_salida, R.fecha_entrada) as noches,
                    CAST(H.precio * DATEDIFF(R.fecha_salida, R.fecha_entrada) AS DECIMAL(10,2)) AS costo_total,
                    F.estatus_pago
                FROM reservas R
                INNER JOIN clientes C ON R.id_cliente = C.id_cliente
                INNER JOIN habitaciones H ON H.num_habitacion = R.num_habitacion
                LEFT JOIN facturas F ON F.id_reserva = R.id_reserva
                
        $fecha_entrada = Yii::$app->request->get('R.fecha_entrada');
        $fecha_salida = Yii::$app->request->get('R.fecha_salida');
        $nombre = Yii::$app->request->get('C.nombre');
        $apellido1 = Yii::$app->request->get('C.apellido1');
        $apellido2 = Yii::$app->request->get('C.apellido2');


        // Construye la consulta SQL base
        $sql = "SELECT C.nombre, C.apellido1, C.apellido2, DATEDIFF(R.fecha_salida, R.fecha_entrada) AS 'Duracion', SUM(H.Precio*(DATEDIFF(R.fecha_salida, R.fecha_entrada))) AS 'TotalReserva'
                FROM reservas R
                INNER JOIN clientes C
                ON R.id_cliente = C.id_cliente
                INNER JOIN habitaciones H
                ON H.num_habitacion = R.num_habitacion
                WHERE 1=1";

        $params = [];
        if ($id_reserva) {
            $sql .= " AND R.id_reserva = :id_reserva";
            $params[':id_reserva'] = $id_reserva;
        }

        $sql .= " ORDER BY R.fecha_entrada DESC";

        // Ejecuta la consulta
        $reservas = Yii::$app->db->createCommand($sql, $params)->queryAll();

        return $this->render('reporte1', [
            'reservas' => $reservas,
        ]);
    }

    /**
     * Reporte 2: Muestra las habitaciones disponibles en un rango de fechas
     */
    public function actionReporte2()
    {
        $fecha_entrada = Yii::$app->request->get('fecha_entrada');
        $fecha_salida = Yii::$app->request->get('fecha_salida');

        $sql = "SELECT 
                    H.num_habitacion,
                    H.tipo,
                    CAST(H.precio AS DECIMAL(10,2)) as 'precio_por_noche',
                    H.disponibilidad
                FROM habitaciones H
                WHERE H.disponibilidad = 1
                AND NOT EXISTS (
                    SELECT 1 
                    FROM reservas R 
                    WHERE R.num_habitacion = H.num_habitacion
                    AND R.estado = 1
                    AND (
                        (R.fecha_entrada <= :fecha_salida AND R.fecha_salida >= :fecha_entrada)
                    )
                )
                ORDER BY H.num_habitacion";

        $params = [
            ':fecha_entrada' => $fecha_entrada,
            ':fecha_salida' => $fecha_salida
        ];

        $habitaciones = Yii::$app->db->createCommand($sql, $params)->queryAll();

        return $this->render('reporte2', [
            'habitaciones' => $habitaciones,
        ]);
    }

    /**
     * Reporte 3: Análisis de popularidad de habitaciones
     */
    public function actionReporte3()
    {
        $num_habitacion = Yii::$app->request->get('num_habitacion');

        $sql = "SELECT 
                    H.num_habitacion,
                    H.tipo,
                    CAST(H.precio AS DECIMAL(10,2)) as precio_por_noche,
                    COUNT(R.id_reserva) as total_reservas,
                    COALESCE(SUM(DATEDIFF(R.fecha_salida, R.fecha_entrada)), 0) as total_noches,
                    CAST(COALESCE(AVG(DATEDIFF(R.fecha_salida, R.fecha_entrada)), 0) AS DECIMAL(10,2)) as promedio_noches,
                    COUNT(DISTINCT R.id_cliente) as clientes_distintos
                FROM habitaciones H
                LEFT JOIN reservas R ON H.num_habitacion = R.num_habitacion
                WHERE 1=1 ";

        $params = [];
        if ($num_habitacion) {
            $sql .= " AND H.num_habitacion = :num_habitacion";
            $params[':num_habitacion'] = $num_habitacion;
        }

        $sql .= " GROUP BY H.num_habitacion, H.tipo, H.precio
                  ORDER BY total_reservas DESC, H.num_habitacion";

        $estadisticas = Yii::$app->db->createCommand($sql, $params)->queryAll();

        return $this->render('reporte3', [
            'estadisticas' => $estadisticas,
        ]);
    }
}