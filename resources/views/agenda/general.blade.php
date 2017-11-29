@extends('layouts.base')
@if($medApps)
@section('title')
Agenda general
@endsection
@endif

@section('styles')
<style type="text/css">
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
        <h4 class="modal-title">Asignar hora médica</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="new_appointment_form">
        	<fieldset>
        		{{ csrf_field() }}
        		<input type="hidden" name="doctor_id" id="doctor_id">
        		<input type="hidden" name="assistaint_id" id="assistaint_id">
        		<input type="hidden" name="patient_id" id="patient_id">
        		
        		<div class="form-group">
        			<label class="control-label col-md-2">Paciente</label>
        			<div class="col-md-10">
        				<input class="form-control" name="" id="patient_search" placeholder="buscar por nombre o apellido">
        			</div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-md-2">Doctor</label>
        			<div class="col-md-10">
        				<input class="form-control" name="" id="doctor_search" placeholder="buscar por nombre o apellido">
        			</div>
        		</div>

        		<div class="form-group">
        			<label class="control-label col-md-2">Asistente</label>
        			<div class="col-md-10">
        				<input class="form-control" name="" id="assistaint_search" placeholder="buscar por nombre o apellido">
        			</div>
        		</div>

        		
        		
        	</fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Asignar nueva hora médica</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('content')

@if($medApps)

<a href="#" class="btn btn-primary btn-sm" onclick="new_appointment_modal()" ><i class="fa fa-plus" aria-hidden="true"></i> Asignar hora médica</a>
<div class="container">
	<div id="calendar"></div>

</div>

@else
<h1 style="color: red">Agenda no disponible</h1>
@endif
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

$('#calendar').fullCalendar({
    locale:'es',
	header: {
		left: 'prev,next today',
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
});
@if($medApps)
	@foreach($medApps as $m)
		 $('#calendar').fullCalendar('renderEvent',{
		 	title:'{{$m->patient->name." ".$m->patient->lastname." [".$m->treatment."]"}}',
		 	start:moment.utc('{{$m->start_time}}', 'YYYY-MM-DD HH:mm:ss').toISOString(),
		 	end:moment.utc('{{$m->end_time}}', 'YYYY-MM-DD HH:mm:ss').toISOString(),
		 	description:'Descripcion ... de prueba...',
		 });
	@endforeach
@endif

$('#myModal').on('hidden.bs.modal', function () {
	$('#new_appointment_form')[0].reset();
})
//$('#calendar').fullCalendar( 'next')
@endsection
</script>