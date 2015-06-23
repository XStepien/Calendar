<?php
$current_month = date('n');
$current_year = date('Y');

$month_names = array(
    '1' => 'janvier',
    '2' => 'février',
    '3' => 'mars',
    '4' => 'avril',
    '5' => 'mai',
    '6' => 'juin',
    '7' => 'juillet',
    '8' => 'août',
    '9' => 'septembre',
    '10' => 'octobre',
    '11' => 'novembre',
    '12' => 'décembre'
);

$creneaux = array(
    '0800-0900' => '08h00 - 09h00',
    '0900-1000' => '09h00 - 10h00',
    '1000-1100' => '10h00 - 11h00',
    '1100-1200' => '11h00 - 12h00',
    '1200-1300' => '12h00 - 13h00',
    '1300-1400' => '13h00 - 14h00',
    '1400-1500' => '14h00 - 15h00',
    '1500-1600' => '15h00 - 16h00',
    '1600-1700' => '16h00 - 17h00',
    '1700-1800' => '17h00 - 18h00',
);

include('connexion.php');
include('function.php');

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {

    if(isset($_POST['param1']) && isset($_POST['currentdate'])){

        $currentDate = explode('-', $_POST['currentdate']);

        $current_month = $currentDate[0];
        $current_year = $currentDate[1];

        $postValue = intval($_POST['param1']);
        if($postValue < 0){
            $current_month--;
        }else{
            $current_month++;
        }

        if($current_month > 12){
            $current_month = 1;
            $current_year++;
        }elseif($current_month < 1){
            $current_month = 12;
            $current_year--;
        }

        $allow_prev = false;
        if(date($current_month.'-'.$current_year) != date('n-Y')){
            $allow_prev = true;
        }

        $retVal = array(
            'data-date' => $current_month.'-'.$current_year,
            'date-string' => $month_names[$current_month].' '.$current_year,
            'html' => draw_calendar($current_month,$current_year),
            'allowprev' => $allow_prev
        );

        echo json_encode($retVal);
    }

    if(isset($_POST['param2']) && isset($_POST['currentdate'])){
        echo show_slots($_POST['currentdate']);
    }
}