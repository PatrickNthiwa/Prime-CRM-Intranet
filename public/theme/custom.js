$(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
});
/**
 * Full calendar Api
 *
 */
$(function () {

    $('#calendar').fullCalendar({
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
        },
        //Random default events
        events    : events,
        editable  : true,
        eventClick: function(info) {
            console.log(info);

            $("#modal-default").find("h4.modal-title").text(info.title);

            $("#modal-default").find(".modal-body p").html(info.description);

            $("#modal-default").modal("show");
        }
    });


    // show or hide events based on category
    $(".bg-light-blue").on("click", function (e) {

        $('.fc-event-container a.pending').toggle();
    });

    $(".bg-yellow").on("click", function (e) {

        $('.fc-event-container a.in-progress').toggle();
    });

    $(".bg-green").on("click", function (e) {

        $('.fc-event-container a.finished').toggle();
    });

});
