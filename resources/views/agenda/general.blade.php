@extends('layouts.base')

@section('title')
Agenda general
@endsection


@section('styles')
<style type="text/css">
  .fc-nonbusiness{
    background-color: black; 
  }

	.fc-today{
		background-color: rgba(186,225,255,.5) !important;
		color:black;
	}
</style>
@endsection

@section('modals')
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrar hora médica</h4>
      </div>
       @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
      <div class="modal-body">
        <form class="form form-horizontal form-label-left" id="new_appointment_form" method="POST" action="{{route('post_new_medical_appointment')}}">
        	<fieldset>
        		{{ csrf_field() }}
        		<input type="hidden" name="doctor_id" id="doctor_id">
        		<input type="hidden" name="assistaint_id" id="assistaint_id">
        		<input type="hidden" name="patient_id" id="patient_id">
        		
        		<div class="col-md-12">


        		<div class="form-group">
        			<label class="control-label col-md-3">Paciente</label>
        			<div class="col-md-9">
        				<input class="form-control" name="" id="patient_search" placeholder="buscar por nombre o apellido ...">
        			</div>
        		</div>

        		<div class="form-group">
        			<label class="control-label col-md-3">Tratamiento</label>
        			<div class="col-md-9">
        				<input type="text" class="form-control" name="treatment" id="" >
        			</div>
        		</div>

        		<div class="form-group">
        			<label class="control-label col-md-3">Doctor</label>
        			<div class="col-md-9">
        				<input class="form-control" name="" id="doctor_search" placeholder="buscar por nombre o apellido ...">
        			</div>
        		</div>

        		<div class="form-group">
        			<label class="control-label col-md-3">Asistente</label>
        			<div class="col-md-9">
        				<input class="form-control" name="" id="assistaint_search" placeholder="buscar por nombre o apellido ...">
        			</div>
        		</div>

        		<div class="form-group">
        			<label class="control-label col-md-3">Fecha y hora de inicio</label>
        			<div class="col-md-9">

			            <div class="input-group date" id="new_fecha_hora_inicio" >
			                <span style="color: blue" class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input readonly type='text' class="form-control" placeholder="" style="z-index: 0" name="start_time">
			            </div>

			        </div>
        		</div>

        		<div class="form-group">
        			<label class="control-label col-md-3">Fecha y hora de fin</label>
        			<div class="col-md-9">
			            <div class="input-group date" id="new_fecha_hora_fin" >
			                <span style="color: blue" class="input-group-addon">
			                   <span class="glyphicon glyphicon-calendar"></span>
			                </span>
			                <input readonly type='text' class="form-control" style="z-index: 0" placeholder="" name="end_time">
			            </div>
			        </div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-md-3">Descripción o comentario</label>
        			<div class="col-md-9">
        				<textarea class="form-control" name="description"></textarea>
        			</div>
        		</div>

        		</div>
        		
        	</fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="$('#new_appointment_form').submit()" data-dismiss="modal">Registrar nueva hora médica</button>
        <button type="submit" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('content')




<div class="col-md-2">
<a href="#" class="btn btn-primary btn-sm" onclick="new_appointment_modal()" ><i class="fa fa-plus" aria-hidden="true"></i> Registrar hora médica</a>  

<div class="row">
  <ul>
  Leyenda de colores
  @foreach($event_colors as $e)
  <li><span style="color: {{$e['color']}}">{{$e['name']}}</span></li>
  @endforeach
  </ul>
</div>
</div>


<div class="col-md-10">
  <div class="col-md-12 pull-right">
      <div id="calendar"></div>
  </div>
</div>


@endsection

<script type="text/javascript">
@section('scripts')
var doctors=[];



function load_data(){
	$("#doctor_search").easyAutocomplete({
	  url: "{{ route('api_get_doctors_list') }}",
	  getValue: "name",
	  list: {	
	    match: {
	      enabled: true
	    },
	    onClickEvent: function() {  
          	var selectedItemValue = $("#doctor_search").getSelectedItemData().id;
            $("#doctor_id").val(selectedItemValue).trigger("change");
        },
	  },
	  theme: "plate-dark",
	  adjustWidth: false,
	});

	$("#assistaint_search").easyAutocomplete({
	  url: "{{ route('api_get_assistaints_list') }}",
	  getValue: "name",
	  list: {	
	    match: {
	      enabled: true
	    },
	    onClickEvent: function() {  
          	var selectedItemValue = $("#assistaint_search").getSelectedItemData().id;
            $("#assistaint_id").val(selectedItemValue).trigger("change");
        },
	  },
	  theme: "plate-dark",
	  adjustWidth: false,
	});

	$("#patient_search").easyAutocomplete({
	  url: "{{ route('api_get_patients_list') }}",
	  getValue: "name",
	  list: {	
	    match: {
	      enabled: true
	    },
	    onClickEvent: function() {  
          	var selectedItemValue = $("#patient_search").getSelectedItemData().id;
            $("#patient_id").val(selectedItemValue).trigger("change");
        },
	  },
	  theme: "plate-dark",
	  adjustWidth: false,
	});

}

function new_appointment_modal(){
	doctors=[]
	get_doctors_list()
}

function get_doctors_list(){
	$.ajax({
      async:true,
      type:"GET",
      url:"{{route('api_get_doctors_list')}}",
      data:{},
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
      success:function(msg){
        doctors=msg;
        load_data();
        $('#myModal').modal('toggle');
      },
    });
}

@endsection

@section('ready_scripts')

datetimepicker_options={
    format: 'yyyy-mm-dd hh:ii',
    language: 'es',
    date:moment().format(),
    todayBtn:true,
    weekStart:1,
    todayHighlight:true,
    autoclose:true,
    startDate:moment().utc().format(),
    daysOfWeekDisabled:[0,6],
}

$('#new_fecha_hora_inicio').datetimepicker(datetimepicker_options);

$('#new_fecha_hora_fin').datetimepicker(datetimepicker_options);


$('#calendar').fullCalendar({
businessHours: {
    // days of week. an array of zero-based day of week integers (0=Sunday)
    dow: [0,1,2,3,4,5,6 ], // Monday - Thursday
    start: '09:00', // a start time (10am in this example)
    end: '20:00', // an end time (6pm in this example)
},
  height:'auto',
  locale:'es',
	header: {
		left: 'prev,next,today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay,list'
	},
	buttonText:{
	    today:    'hoy',
	    month:    'mes',
	    week:     'semana',
	    day:      'día',
	    list:     'lista'
	},
  events:'{{route("api_agenda_events")}}',
});



@if($errors->any())
  load_data();
	$('#myModal').modal('show');
@endif


$('#myModal').on('hidden.bs.modal', function () {
	$('#new_appointment_form')[0].reset();
})


@endsection
</script>