
<div id="calendar">
<!-- Modal -->
<div class="modal fade" id="schedule_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos Cita Donación </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="form-group col-sm-6">
                <label for="name">Nombres:</label>
                <label for="" id="name" class="labelDonation"></label>
                <input hidden  name="schedule_id" id="schedule_id">
            </div>
            <div class="form-group col-sm-6">
                <label for="lastname">Apellidos:</label>
                <label for="" id="lastname" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="blood_type">Grupo Sanguineo: </label>
                <label for="" id="blood_type" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="phone_number">Celular: </label>
                <label for="" id="phone_number" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="country">Provincia: </label>
                <label for="" id="country" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="city">Ciudad: </label>
                <label for="" id="city" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-12">
                <label for="donation_center">Centro de Donación: </label>
                <label for="" id="donation_center" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-12">
                <label for="address">Dirección: </label>
                <label for="" id="address" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-12">
                <label for="email_center">Correo Centro: </label>
                <label for="" id="email_center" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="phone_center">Teléfono Centro: </label>
                <label for="" id="phone_center" class="labelDonation"></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="donation_type">Tipo Donación: </label>
                <label for="" id="donation_type" class="labelDonation"></label>
            </div>

            <div class="form-group col-sm-6">
                <label for="donation_date">Fecha Donación: </label>
                <input type="date" name="" id="donation_date">
            </div>
            <div class="form-group col-sm-6">
                <label for="donation_time">Hora Donación: </label>
                <input type="time" name="" id="donation_time">

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnUpdate" class="btn btn-primary">Modificar</button>
        </div>
      </div>
    </div>
  </div>

<style>
    .labelDonation{
        font-weight: 400 !important
    }
    #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        let  days= Object.values ( @json($daysWithoutSchedules));

        var calendarEl = document.getElementById('calendar');
        var initialLocaleCode = 'es';
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

            editable:true,
            eventLimit: true,
            header:{
                left:'prev,next today',
                center:'title',
                //right:'month,agendaWeek'
                //right:'agendaWeek,month',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            //defaultView: 'agendaWeek',
            locale: initialLocaleCode,
            hiddenDays:days,
            events: @json($dataschedule),
            selectable:true,
            selectHelper: true,
            scrollTime: '00:00',
            slotLabelFormat:
            {
                hour: 'numeric',
                minute: '2-digit',
                omitZeroMinute: false,
            },
            eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            minTime: "07:00:00",
            maxTime: "20:00:00",

            /*dateClick:function(info){
                console.log(info);
            },*/
            eventClick:function(info){
                //var modalToggle = document.getElementById('schedule_modal')

                var info=info.event.extendedProps;

                $('#schedule_modal').modal('show');
                $('#schedule_id').val(info.schedule_id);
                $('#name').text(info.name);
                $('#lastname').text(info.lastname);
                $('#blood_type').text(info.blood_type);
                $('#phone_number').text(info.phone_number);
                $('#country').text(info.country);
                $('#city').text(info.city);
                $('#donation_center').text(info.donation_center);
                $('#address').text(info.address);
                $('#phone_center').text(info.phone_center);
                $('#email_center').text(info.email_center);
                $('#donation_date').val(info.donation_date);
                $('#donation_time').val(info.donation_time);
                $('#donation_type').text(info.donation_type);
            },

            select:function(start, end, allDay)
            {
                console.log(start);

            },

            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },
            eventDrop: function(event, delta)
            {

            },


        });


        calendar.render();

        $('#btnUpdate').click( function(){

            objEvent = storeData("PATCH");
            $('#btnUpdate').prop('disabled', true);

            sendData('/'+ $('#schedule_id').val() ,objEvent);

        });

        function storeData(method){

            schedule={
                id:$('#schedule_id').val(),
                donation_date:$('#donation_date').val(),
                donation_time:$('#donation_time').val(),
                //note:$('#').val(),

                '_token':$("meta[name='csrf-token']").attr("content"),
                'method':method
            }

            return (schedule)
        }

        function sendData(accion,objEvent){
            $.ajax(
                {
                    type:"POST",
                    url:"{{ url('/schedules') }}"+accion,
                    data:objEvent,
                    success :function(msg){
                        console.log(msg);
                        location. reload()
                        $('#schedule_modal').modal('toggle');
                        //calendarEl.refetchEvents();

                    },
                    error:function(){
                        alert('Error')
                    }
                }
            );
        }
    });

</script>
