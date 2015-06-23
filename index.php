<?php
include('calendar.php');
?>
<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <title>PHP/Jquery Calendar</title>
    <link rel="stylesheet" href="calendar.css"/>
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

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.0/jquery.scrollTo.min.js"></script>
    <script src="calendar.js"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').calendar();
        });
    </script>
</body>
</html>