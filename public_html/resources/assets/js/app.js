/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.moment = require('moment');
require('fullcalendar');
require('bootstrap-datepicker');

$(document).ready(function() {

    /*
    * FullCalendar used on the events page
    * */
    $('#calendar').fullCalendar({
        displayEventTime: false,
        events: function(start, end, timezone, callback) {
            jQuery.ajax({
                url: '/events',
                type: 'GET',
                dataType: 'json',
                data: {
                    start: start.format(),
                    end: end.format()
                },
                success: function(doc) {
                    var events = [];
                    if(doc.length){
                        $.map( doc, function( r ) {
                            events.push({
                                id: r.id,
                                title: r.title,
                                start: moment(r.date, 'DD/MM/YYYY').toDate(),
                            });
                        });
                    }
                    callback(events);
                }
            });
        }
    })

    /*
    * Initialise bootstrap-datepicker input.date
    * */
    $('input.date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });

    /*
    * Handle delete event modal
    * */
    $('#confirmDelete').on('show.bs.modal', function(e) {

        // get data-event-id attribute of the clicked element
        var event_id = $(e.relatedTarget).data('event-id');

        // populate the delete form
        $(e.currentTarget).find('#delete-event-form').attr('action', '/events/' + event_id);
    });


});
