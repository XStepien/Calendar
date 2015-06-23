$(document).ready(function() {

    //jQuery.fn.visible = function() {
    //    return this.css('visibility', 'visible');
    //};
    //
    //jQuery.fn.invisible = function() {
    //    return this.css('visibility', 'hidden');
    //};
    //
    //jQuery.fn.visibilityToggle = function() {
    //    return this.css('visibility', function(i, visibility) {
    //        return (visibility == 'visible') ? 'hidden' : 'visible';
    //    });
    //};

    // Option par default
    var o = {
    };

    $.fn.calendar = function(oo){
        if(oo) $.extend(o,oo);

        var $calendar = this;

        $calendar.on('click', '.available', function(event){
            var $this = $(event.currentTarget);
            var $isActive = $this.hasClass('active');

            var selectedDate = $this.data('date');

            // chercher si un td class active existe deja!
            $calendar.find('td.active').removeClass('active');
            $calendar.find('.booking-container').remove();

            if(!$isActive){
                $currentTr = $this.closest('tr');

                $this.addClass('active');
                var $booking = $('<tr><td colspan="7">').insertAfter($currentTr).addClass('booking-container');
                $booking.show('slow');



                var $booking_content = $('<div>').addClass('booking-content').appendTo($booking.find('td')).hide();
                $('<span>').addClass('loader').appendTo($booking.find('td'));

                $.ajax({
                    method: "POST",
                    url: 'calendar.php',
                    data: { param2: 'creneau', currentdate: selectedDate }
                }).done(function(data){
                    $booking_content.html(data).fadeIn();
                    $(window).scrollTo($("#slots-title"),500, {offset : -100});
                }).fail(function(){
                    $('<p>').html('Une erreur c\'est produite...').appendTo($booking_content);
                }).always(function(){
                    $booking.find('.loader').remove();
                });

            }

        }).on('click', '.arrow', function(event){
            event.preventDefault();
            var $this = $(event.currentTarget);
            console.log($this.attr('class'));

            var currentDate = $calendar.find('.month-name').data('date');
            var addValue = ($this.hasClass('arrow-next')) ? 1 : -1;

            var $calBody = $calendar.find('tbody');
            $calBody.css('opacity', 0.4);

            $calendar.find('.arrow-prev').css('visibility', 'hidden');

            $.ajax({
                method: "POST",
                url: 'calendar.php',
                data: { param1: addValue, currentdate: currentDate }
            }).done(function(data){
                var dataArray = jQuery.parseJSON(data);

                if(dataArray['allowprev'] == true){
                    $calendar.find('.arrow-prev').css('visibility', 'visible');
                }else{
                    $calendar.find('.arrow-prev').css('visibility', 'hidden');
                }

                $calBody.html(dataArray['html']);
                $calendar.find('.month-name').html(dataArray['date-string']).data('date', dataArray['data-date']);

            }).fail(function(){
                console.log('fail');
            }).always(function(){
                $calBody.css('opacity', 1);
            });
        });

    }



});
