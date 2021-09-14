<x-backend.layout>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Calendar</h1>
        </div>
    </header>

    <hr />

    <div class="mt-5" id='calendar'></div>

    @push('styles')
        <style type="text/css">
            
            .tooltipevent{
                width:350px;
                background:#FFF;
                position:absolute;
                z-index:10001;
                transform:translate3d(-50%,-100%,0);
                font-size: 16px;
                box-shadow: 0px 0px 3px 0px #888888;
                line-height: 1rem; 
                padding:10px;
            }
            .tooltipevent div{
                padding:8px;
            }
            .tooltipevent div:last-child{
                background-color:whitesmoke;
                position:relative;
            }
            .tooltipevent div:last-child::after, .tooltipevent div:last-child::before{
                width:0;
                height:0;
                border:solid 5px transparent;
                border-bottom:0;
                border-top-color:whitesmoke;
                position: absolute;
                display: block;
                content: "";
                bottom:-4px;
                left:50%;
                transform:translateX(-50%);
            }
            .tooltipevent div:last-child::before{
                border-top-color:#FFF;
                bottom:-5px;
            }
        </style>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush
    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
        <script>
    
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                   eventMouseEnter: function(info) {
                        var tis=info.el;
                        var popup=info.event.extendedProps.popup;
                        var tooltip = '<div class="tooltipevent" style="top:'+($(tis).offset().top-5)+'px;left:'+($(tis).offset().left+($(tis).width())/2)+'px"><div class="auction_start_date_time"> Start date time: ' + info.event.extendedProps.start_date_time + '</div><div class="auction_end_date_time"> End date time: ' + info.event.extendedProps.end_date_time + '</div><div class="auction_detail"> Details: ' + info.event.extendedProps.description + '</div><div class="auction_list_count"> Listings: ' + info.event.extendedProps.listings + '</div></div>';
                        var $tooltip = $(tooltip).appendTo('body');
                    },
                    eventMouseLeave: function(info) {
                        $(info.el).css('z-index', 8);
                        $('.tooltipevent').remove();
                    },
                });
                calendar.addEventSource( {
                    url: '/api/calendar/events',
                });
                calendar.render();
            });
      
        </script>
    @endpush

</x-backend.layout>