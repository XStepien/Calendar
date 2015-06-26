<?php
//include('calendar.php');
include('class/calendar.php');

$calendar = new Calendar();
?>
<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <title>PHP/Jquery Calendar</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/calendar.css"/>
    <link rel="stylesheet" href="css/modal.css"/>
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="icon-calendar"></i> PHP/Jquery Calendar <small>By Blondin</small></h1>
        </div>
    </header>
    <section>
        <div class="container">
            <table id="calendar">
                <?php
                    echo $calendar->draw_calendar();
                ?>
            </table>
        </div>
    </section>

    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <button type="button" class="md-close" aria-label="Close" onclick="$('#modal-1').removeClass('md-show');"><span class="icon-cross"></span></button>
            <h3>Demande de rendez-vous</h3>
            <p class="recap">
                <span class="recap-date"><i class="icon-calendar"></i> Jeudi 25 Juin 2015</span>
                <span class="recap-heure"><i class="icon-clock"></i> 9h00 - 9h20</span>
            </p>
            <div class="rdv-form-wrapper">
                <form action="" method="POST" id="rdv-form">
                    <div class="field">
                        <input type="text" placeholder="Nom..."/>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Prénom..."/>
                    </div>
                    <div class="field">
                        <input type="email" placeholder="Email..."/>
                    </div>
                    <div class="field">
                        <input type="tel" placeholder="Téléphone..."/>
                    </div>
                    <div class="field field-block">
                        <label for="text-area">Laissez moi un message</label>
                        <textarea id="text-area"></textarea>
                    </div>
                </form>
            </div>

            <button class="btn btn-close" onclick="$('#modal-1').removeClass('md-show');">Annuler</button>
            <button class="btn btn-available" onclick="$('#rdv-form').submit();">Envoyer</button>
        </div>
    </div>

    <div class="md-overlay"></div>


    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.0/jquery.scrollTo.min.js"></script>
    <script src="js/calendar.js"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').calendar();
        });
    </script>
</body>
</html>