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
        $id_reserva = Yii::$app->request->get('R.id_reserva');
        $fecha_entrada = Yii::$app->request->get('R.fecha_entrada');
        $fecha_salida = Yii::$app->request->get('R.fecha_salida');
        $nombre = Yii::$app->request->get('C.nombre');
        $apellido1 = Yii::$app->request->get('C.apellido1');
        $apellido2 = Yii::$app->request->get('C.apellido2');


        // Construye la consulta SQL base
        $sql = "SELECT C.nombre, C.apellido1, C.apellido2, DATEDIFF(R.fecha_salida,R.fecha_entrada) AS 'Dias'
                FROM reservas R
                INNER JOIN clientes C
                ON R.id_cliente = C.id_cliente
                WHERE 1=1";
                // Esta linea siempre es verdadera y permite agregar and de forma dinamica
        // Agrega condiciones de filtro dinámicamente si son mandados
        $params = [];
        if ($id_reserva) {// Si el parametro trae un valor
            $sql .= " R.id_reserva = :id_reserva";
            $params[':id_reserva'] = "id_reserva";
        }
        // Ejecuta la consulta
        $reservas = Yii::$app->db->createCommand($sql, $params)->queryAll();

        //Mandamos a la vista el conjunto de registros retornados en la variable $empleados
        return $this->render('reporte1', [
            'alumnos' => $reservas,
        ]);
        return $this->render('reporte1');
    }

    public function actionReporte2()
    {
        return $this->render('reporte2');
        
    }

    public function actionReporte3()
    {
        return $this->render('reporte3');
    }

}
