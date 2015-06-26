<?php

class Calendar {

    private $month_name = array(
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
    private $day_name = array(
        'lun',
        'mar',
        'mer',
        'jeu',
        'ven',
        'sam',
        'dim'
    );

    private $month;
    private $year;

    public function __construct($month = null,$year = null)
    {
        $this->month = (null != $month) ? $month : date('n');
        $this->year = (null != $year)? $year : date('Y');
    }

    /**
     * @return string
     */
    public function draw_calendar()
    {
        $h = $this->draw_header();
        $b = $this->draw_body();

        return $h.$b;
    }

    /**
     * @return string
     */
    public function draw_header()
    {
        // Draw header
        $header = '<thead>';
        $header.= '<tr><th colspan="7">';
        if(date($this->month.'-'.$this->year) != date('n-Y')){
            $header.= '<a href="#" class="arrow arrow-prev"><span class="icon-circle-left"></span></a>';
        }else{
            $header.= '<a href="#" class="arrow arrow-prev" style="visibility: hidden"><span class="icon-circle-left"></span></a>';
        }
        $header.= '<span class="month-name" data-date="'.$this->month.'-'.$this->year.'">';
        $header.= $this->month_name[$this->month].' '.$this->year;
        $header.= '</span>';
        $header.= '<a href="#" class="arrow arrow-next"><span class="icon-circle-right"></span></a>';
        $header.= '</th></tr>';
        $header.= '<tr class="days">';
        foreach($this->day_name as $day){
            $header.= '<th>'.$day.'</th>';
        }
        $header.= '</tr>';
        $header.= '</thead>';

        return $header;
    }

    /**
     * @return string
     */
    public function draw_body()
    {
        $date = strtotime($this->year.'-'.$this->month.'-1');
        $today = date('j-n-Y');
        $running_day = date('N',$date);
        $days_in_month = date('t',$date);
        $days_in_this_week = 1;
        $day_counter = 0;

        $body = '<tbody>';
        $body.= '<tr class="week">';

        if($running_day < 8)
        {
            for($x = 1; $x < $running_day; $x++):
                $before_day = date('j',mktime(0,0,0,$this->month,$x - $running_day,$this->year));
                $body.= '<td class="blur">'.$before_day.'</td>';
                $days_in_this_week++;
            endfor;
        }

        for($list_day = 1; $list_day <= $days_in_month; $list_day++):

            $class = (strtotime($this->year.'-'.$this->month.'-'.$list_day) < strtotime('now -1 DAY'))? 'prev-date': 'available';
            $class.= ($today == $list_day.'-'.$this->month.'-'.$this->year)? ' today' : '';

            // voir avec un array 'jour de fermeture' + check in_array
            if($running_day>5){
                $class = 'prev-date';
            }

            $date_string = $this->year.'-'.$this->month.'-'.$list_day;

            $body.= "<td data-date='$date_string' class='$class'>";
            $body.= '<span class="number">'.$list_day.'</span>';
            $body.= '</td>';

            if($running_day == 7):
                $body.= '</tr>';
                if(($day_counter+1) != $days_in_month):
                    $body.= '<tr class="week">';
                endif;
                $running_day = 0;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;

        if($days_in_this_week < 8):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $body.= '<td class="blur">'.$x.'</td>';
            endfor;
        endif;

        $body.= '</tr>';
        $body.= '</tbody>';

        return $body;
    }

    public function show_slots()
    {
    }
}