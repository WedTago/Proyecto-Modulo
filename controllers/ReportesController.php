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

    public function actionReporte1()
{
    $id_reserva = Yii::$app->request->get('id_reserva');
    $nombre_cliente = Yii::$app->request->get('nombre_cliente');
    $costo_min = Yii::$app->request->get('costo_min');
    $costo_max = Yii::$app->request->get('costo_max');
    $estatus_pago = Yii::$app->request->get('estatus_pago');
    $ordenar_por = Yii::$app->request->get('ordenar_por', 'fecha_entrada');
    $direccion_orden = Yii::$app->request->get('direccion_orden', 'DESC');

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
            WHERE 1=1";

    $params = [];

    if ($id_reserva) {
        $sql .= " AND R.id_reserva = :id_reserva";
        $params[':id_reserva'] = $id_reserva;
    }

    if ($nombre_cliente) {
        $sql .= " AND (C.nombre LIKE :nombre_cliente OR 
                       C.apellido1 LIKE :nombre_cliente OR 
                       C.apellido2 LIKE :nombre_cliente)";
        $params[':nombre_cliente'] = "%{$nombre_cliente}%";
    }

    if ($costo_min !== null && $costo_min !== '') {
        $sql .= " AND (H.precio * DATEDIFF(R.fecha_salida, R.fecha_entrada)) >= :costo_min";
        $params[':costo_min'] = $costo_min;
    }

    if ($costo_max !== null && $costo_max !== '') {
        $sql .= " AND (H.precio * DATEDIFF(R.fecha_salida, R.fecha_entrada)) <= :costo_max";
        $params[':costo_max'] = $costo_max;
    }

    if ($estatus_pago !== null && $estatus_pago !== '') {
        $sql .= " AND F.estatus_pago = :estatus_pago";
        $params[':estatus_pago'] = $estatus_pago;
    }

    $allowed_order_fields = [
        'id_reserva' => 'R.id_reserva',
        'costo_total' => 'costo_total',
        'fecha_entrada' => 'R.fecha_entrada',
        'noches' => 'noches'
    ];

    $order_field = $allowed_order_fields[$ordenar_por] ?? 'R.fecha_entrada';
    $order_direction = in_array(strtoupper($direccion_orden), ['ASC', 'DESC']) ? $direccion_orden : 'DESC';

    $sql .= " ORDER BY {$order_field} {$order_direction}";

    $reservas = Yii::$app->db->createCommand($sql, $params)->queryAll();

    return $this->render('reporte1', [
        'reservas' => $reservas,
    ]);
}

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