
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
            <div class="form-group col-sm-12">
                <label for="phone_center">Teléfono Centro: </label>
                <label for="" id="phone_center" class="labelDonation"></label>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<style>
    .labelDonation{
        font-weight: 400 !important
    }
</style>


<script>

    $(document).ready(function () {
    
        let  days= Object.values ( @json($dataschedule['daysWithoutSchedules']));
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        var calendar = $('#calendar').fullCalendar({

            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                //right:'month,agendaWeek'
                 right:'agendaWeek,month',
            },
            defaultView: 'agendaWeek',
           /* events:[
                {
                    title:"pruebas",
                    start:"2022-12-16 12:30:00",
                    end:"2022-12-16 13:00:00"
                }
            ],*/
            hiddenDays:days,
            events: @json($dataschedule),
            selectable:true,
            selectHelper: true,
            slotLabelFormat:"HH:mm",
            minTime: "07:00:00",
            maxTime: "20:00:00",
           
            /*dateClick:function(info){
                console.log(info);
            },*/
            eventClick:function(info){
                //var modalToggle = document.getElementById('schedule_modal')
                $('#schedule_modal').modal('show');  
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
            },

            select:function(start, end, allDay)
            {
                console.log(start);
                var dateSchedule = $.fullCalendar.formatDate(start, 'Y-MM-DD');
                var timeSchedule = $.fullCalendar.formatDate(start, 'HH:mm:ss');
               $('#donation_date').val(dateSchedule);
               $('#donation_time').val(timeSchedule);
               $('#schedule_modal').modal('show');
               //calendar.addEvent({title:"pru",date:info.dateStr});
    
                /*if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
    
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
    
                    $.ajax({
                        url:"/full-calender/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Successfully");
                        }
                    })
                }*/
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
    
            /*eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"/full-calender/action",
                        type:"POST",
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Deleted Successfully");
                        }
                    })
                }
            }*/
        });
    
        function sendSchedule(){
            
        }
    });
      
    </script>