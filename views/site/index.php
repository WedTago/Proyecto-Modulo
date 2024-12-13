<?php

/** @var yii\web\View $this */

$this->title = 'Hotel La Palma';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-light py-5">
        <h1 class="display-4">Bienvenido a Hotel La Palma</h1>
        <p class="lead">Disfruta de la experiencia de lujo y confort en el mejor destino Cumpas.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <!-- Mensaje mamalon -->
            <div class="col-md-6">
                <h1>¿Dónde estamos?</h1>
                <p>Descubre nuestra ubicación privilegiada en el corazón de la sierra. El Hotel La Palma te ofrece comodidad y lujo en un solo lugar, todo a un precio accesible.</p>
            </div>

            <!-- Mapa :D-->
             <!-- Fue mucho mas sencillo de lo que crei-->
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.0610624101223!2d-109.78022372444823!3d29.99137357495035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86cfe4bc706e8b73%3A0xd451bc59fa5fb7b4!2sHotel%20La%20Palma!5e1!3m2!1ses-419!2smx!4v1734070098115!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- Calendario :D -->
        <div class="mt-4 text-center">
            <h2>Bienvenido!</h2>
            <p id="current-date"></p>
        </div>
    </div>
</div>

<script>
    function updateDate() {
        const dateElement = document.getElementById('current-date');
        const today = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateElement.textContent = today.toLocaleDateString(undefined, options);
    }

    // Aqui actualizo la fecha cada vez que entra a la pagina
    updateDate();

    // Actualiza la fecha a media noche (Creo)
    setInterval(updateDate, 24 * 60 * 60 * 1000);
</script>
