<?php
function draw_calendar($month,$year)
{

    /* draw table */
    $calendar = '';

    /* days and weeks vars now ... */
    $date = strtotime($year.'-'.$month.'-1');

    $today = date('j-n-Y');

    $running_day = date('N',$date);

    $days_in_month = date('t',$date);
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    $calendar.= '<tr class="week">';

    if($running_day < 8)
    {
        for($x = 1; $x < $running_day; $x++):
            $before_day = date('j',mktime(0,0,0,$month,$x - $running_day,$year));
            $calendar.= '<td class="blur">'.$before_day.'</td>';
            $days_in_this_week++;
        endfor;
    }

    for($list_day = 1; $list_day <= $days_in_month; $list_day++):

        $class = (strtotime($year.'-'.$month.'-'.$list_day) < strtotime('now -1 DAY'))? 'prev-date': 'available';
        $class.= ($today == $list_day.'-'.$month.'-'.$year)? ' today' : '';

        if($running_day>5){
            $class = 'prev-date';
        }

        $date_string = $year.'-'.$month.'-'.$list_day;

        $calendar.= "<td data-date='$date_string' class='$class'>";
        $calendar.= '<span class="number">'.$list_day.'</span>';
        $calendar.= '</td>';

        if($running_day == 7):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="week">';
            endif;
            $running_day = 0;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="blur">'.$x.'</td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    return $calendar;
}

function show_slots($currentDate)
{
    $slots = '<h2 id="slots-title">Créneaux disponible :</h2>';

    global $creneaux, $pdo;

    foreach($creneaux as $key => $value){

        $count= $pdo->prepare("SELECT COUNT(*) FROM rendezvous WHERE rdvHeure = :heure AND rdvDate = :currentdate");
        $count->execute(array('heure' => $key,'currentdate' => $currentDate));
        $count = $count->fetchColumn();

        $nbDispo = 3 - $count;

        $slots.= '<div class="timeslot">';

        $slots.= '<span class="timeslot-time">';
        $slots.=    '<span class="icon-clock"></span> ';
        $slots.=    $value;
        $slots.= '</span>';

        $slots.= '<span class="timeslot-count">';
        $slots.=    '<span class="slot-available">'.$nbDispo.' créneaux disponible</span>';
        $slots.= '</span>';

        $slots.= '<span class="timeslot-action">';

        if($nbDispo==0){
            $slots.=    '<a href="#" class="btn btn-full" data-heure='.$key.'>indisponible</a>';
        }else{
            $slots.=    '<a href="#" class="btn btn-available" data-heure='.$key.'>Prendre rendez-vous</a>';
        }

        $slots.= '</span>';

        $slots.= '</div>';
    }

    return $slots;
}