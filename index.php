<?php
include('calendar.php');
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
            <h1>PHP/Jquery Calendar <small>By Blondin</small></h1>
        </div>
    </header>
    <section>
        <div class="container">
            <table id="calendar">
                <thead>
                    <tr>
                        <th colspan="7">
                            <a href="#" class="arrow arrow-prev">
                                <span class="icon-circle-left"></span>
                            </a>
                            <span class="month-name" data-date="<?=$current_month.'-'.$current_year?>"><?=$month_names[$current_month].' '.$current_year?></span>
                            <a href="#" class="arrow arrow-next">
                                <span class="icon-circle-right"></span>
                            </a>
                        </th>
                    </tr>
                    <tr class="days">
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Mer</th>
                        <th>Jeu</th>
                        <th>Ven</th>
                        <th>Sam</th>
                        <th>Dim</th>
                    </tr>
                </thead>
                <tbody id="calendar-body">
                    <?php
                    echo draw_calendar(6,2015);
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="md-modal md-effect-8" id="modal-1">
        <div class="md-content">
            <h3>Demande de rendez-vous</h3>
            <p class="recap">
                <span class="recap-date"><i class="icon-clock"></i> Jeudi 25 Juin 2015</span>
                <span class="recap-heure"><i class="icon-clock"></i> 9h00 - 9h20</span>
            </p>
            <div class="rdv-form">
                <form action="" method="POST">
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
                        <label for="text-area">Un message</label>
                        <textarea id="text-area"></textarea>
                    </div>
                </form>
            </div>

            <button class="md-close btn btn-close" onclick="$('#modal-1').removeClass('md-show');">Annuler</button>
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