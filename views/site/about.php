<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Autores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6 text-center">
            <h2>Juan Laborin</h2>
            <img
                src="https://media.tenor.com/d13jPFfU24YAAAAi/maxwell-christmas.gif"
                width="350px"
                height="350px"
                class="rounded-circle mb-3"
                alt="Juan Laborin"
            >
            <p>
                "Soy un alumno del CBTA #53 que esta haciendo este proyecto para pasar la materia y de paso aprender un poco del mundo de la programacion, el cual es curioso"
            </p>
            <p><i>- Juan Laborin</i></p>
        </div>
        <div class="col-md-6 text-center">
            <h2>Victor Monge</h2>
            <img
                src="https://media1.tenor.com/m/Jiiemy3hCrAAAAAd/fish.gif"
                width="350px"
                height="350px"
                class="rounded-circle mb-3"
                alt="Victor Monge"
            >
            <p>
                "Una conciencia limpia es por lo general, una señal de mala memoria"
            </p>
            <p><i>-Un alumno promedio de ofimatica</i></p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 text-center">
            <p>Materia: Modulo 4</p>
            <p>Fecha: 16/Diciembre/2024</p>
            <p>Maestro: Jesus Bremont</p>
        </div>
    </div>
</div>



