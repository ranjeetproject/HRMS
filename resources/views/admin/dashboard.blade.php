@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3"><h5>Dashboard</h5></div>
                            <div class="col-sm-9">
                                <div id="external-events" style="position: absolute;/*top: 0px;left: 150px;*/display: flex;">
                                    {{--<div class="external-event bg-warning" style="margin-right: 5px;/*height: 35px;*/border-radius: 25px;">A</div>
                                    <div class="external-event bg-info" style="margin-right: 5px;/*height: 35px;*/border-radius: 25px;">B</div>
                                    <div class="external-event bg-primary" style="margin-right: 5px;/*height: 35px;*/border-radius: 25px;">C</div>
                                    <div class="external-event bg-danger" style="margin-right: 5px;/*height: 35px;*/border-radius: 25px;">D
                                    </div>--}}
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    {{--<div class="col-md-4">
                        <div id="external-events" style="position: absolute;top: 10px;left: 150px;display: flex;">
                            <div class="external-event bg-success" style="margin-right: 5px;height: 35px;">Party</div>
                            <div class="external-event bg-info" style="margin-right: 5px;height: 35px;">Venue</div>
                            <div class="external-event bg-primary" style="margin-right: 5px;height: 35px;">Class</div>
                            <div class="external-event bg-danger" style="margin-right: 5px;height: 35px;">Treatment
                            </div>
                        </div>
                    </div>--}}
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                               {{-- <div id="calendar"></div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--- -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <!--- -->


@endsection
@section('customJsInclude')
    <script src="{{asset('vendor/adminlte/dist/js/moment.min.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/js/full_main.min.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/js/fullcalendar-daygrid_main.min.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/js/fullcalendar-timegrid_main.min.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/js/fullcalendar-interaction_main.min.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/js/fullcalendar-bootstrap_main.min.js')}}"></script>
    <script>
        $(function () {
            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {
                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }
                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)
                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })
                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendarInteraction.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    console.log(eventEl);
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                //Random default events
                events: ''
                [
                    {
                        title: 'Click for Google',
                        start: "2020-02-06T08:30",
                        end:  "2020-02-06T11:00",
                        url: 'http://google.com/',
                        allDay: false,
                        backgroundColor: '#3c8dbc', //Primary (light-blue)//'#00a65a', //Success (green)//'#f56954'
                        borderColor: '#3c8dbc' //Primary (light-blue)//'#00c0ef', //Info (aqua)//'#0073b7'//#f39c12
                    }
                ],
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                eventClick: function (event) {

                    var startTime=event.event.start;
                    if(startTime!=null)
                    {
                        var startHours = startTime.getHours();
                        var startMinutes = startTime.getMinutes();
                        var ampm = startHours >= 12 ? 'pm' : 'am';
                        startHours = startHours % 12;
                        startHours = startHours ? startHours : 12; // the hour '0' should be '12'
                        startMinutes = startMinutes < 10 ? '0'+startMinutes : startMinutes;
                        var strTime = startHours + ':' + startMinutes + ' ' + ampm;
                    }

                    var endTime=event.event.end;
                    if(endTime!=null)
                    {
                        var endHours = endTime.getHours();
                        var endMinutes = endTime.getMinutes();
                        var ampm = endHours >= 12 ? 'pm' : 'am';
                        endHours = endHours % 12;
                        endHours = endHours ? endHours : 12; // the hour '0' should be '12'
                        endMinutes = endMinutes < 10 ? '0'+endMinutes : endMinutes;
                        var endStrTime = endHours + ':' + endMinutes + ' ' + ampm;
                    }


                    $("#successModal").modal("show");
                    if(endTime!=null && startTime!=null)
                    {
                        $("#successModal .modal-body p").html(event.event.title+' at '+strTime+' to '+endStrTime);
                    }
                    else{
                        $("#successModal .modal-body p").html(event.event.title);
                    }

                }

            });

            calendar.render();
            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
        })
    </script>
@endsection
