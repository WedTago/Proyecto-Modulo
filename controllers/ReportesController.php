<?php

namespace app\controllers;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReporte1()
    {
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
