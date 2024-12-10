<?php

namespace app\controllers;

use app\models\Habitaciones;
use app\models\HabitacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HabitacionesController implements the CRUD actions for Habitaciones model.
 */
class HabitacionesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Habitaciones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HabitacionesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Habitaciones model.
     * @param int $num_habitacion Num Habitacion
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($num_habitacion)
    {
        return $this->render('view', [
            'model' => $this->findModel($num_habitacion),
        ]);
    }

    /**
     * Creates a new Habitaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Habitaciones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'num_habitacion' => $model->num_habitacion]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Habitaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $num_habitacion Num Habitacion
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($num_habitacion)
    {
        $model = $this->findModel($num_habitacion);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'num_habitacion' => $model->num_habitacion]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Habitaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $num_habitacion Num Habitacion
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($num_habitacion)
    {
        $this->findModel($num_habitacion)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Habitaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $num_habitacion Num Habitacion
     * @return Habitaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($num_habitacion)
    {
        if (($model = Habitaciones::findOne(['num_habitacion' => $num_habitacion])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
