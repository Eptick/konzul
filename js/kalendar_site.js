function init_kalendar()
{
	// TODO Kalendar ono dragabke maknut
    if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
    console.log('Kalendar inicijaliziran');
        
    var calendar = $('#kalendar').fullCalendar({
        header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
        },
        selectable: false, // Dal se mogu dodavati sami termini
        selectHelper: true,
        select: function(start, end, allDay) { // Ovo služi da se mogu unositi custom termini
        $('#fc_create').click();

        started = start;
        ended = end;

        $(".antosubmit").on("click", function() {
            var title = $("#title").val();
            if (end) {
            ended = end;
            }

            categoryClass = $("#event_type").val();

            if (title) {
            calendar.fullCalendar('renderEvent', {
                title: title,
                start: started,
                end: end,
                allDay: allDay
                },
                true // make the event "stick"
            );
            }

            $('#title').val('');

            calendar.fullCalendar('unselect');

            $('.antoclose').click();

            return false;
        });
        },
        eventClick: function(calEvent, jsEvent, view) { // Ovo je edit, ili ubacivanje
        $('#fc_edit').click();
        $('#title2').val(calEvent.title);
        $('#descr2').val(calEvent.note);

        categoryClass = $("#event_type").val();

        $(".antoodbij").on("click", function() {
            calEvent.title = $("#title2").val();
            calEvent.note = $("#descr2").val();

            calendar.fullCalendar('updateEvent', calEvent);
            $.ajax( "../api/odbij_naknadno?hash="+  calEvent.title)
                .done(function() {
                     $('.antoclose2').click();
                     // Ovdje stavi Pnotify
                })

           
        });

        $(".antosubmit2").on("click", function() {
            calEvent.title = $("#title2").val();
            calEvent.note = $("#descr2").val();

            calendar.fullCalendar('updateEvent', calEvent);
            $.ajax( "../api/update_komentar?hash="+  calEvent.title + "&komentar="+calEvent.note)
                .done(function() {
                     $('.antoclose2').click();
                })

           
        });

        calendar.fullCalendar('unselect');
        },
        editable: true,
        events: "../api/termini"
    });
}

$(document).ready(function() {				
		init_kalendar()
});	
