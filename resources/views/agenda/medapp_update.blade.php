@extends('layouts.base')
@section('title','Actualizar hora médica')
@section('panel_title')
<a class="col-md-4 btn btn-sm btn-primary" href="{{route('medapp_details',$medapp->id)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
 Cancelar y Volver a Detalles de hora médica</a>
@endsection
@section('content')

<form class="form-horizontal form-label-left" id="new_appointment_form" method="POST" action="{{route('post_update_medapp')}}">
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<fieldset>
		{{ csrf_field() }}
		<input type="hidden" name="doctor_id" id="doctor_id">
		<input type="hidden" name="assistaint_id" id="assistaint_id">
		<input type="hidden" name="patient_id" id="patient_id">
		<input type="hidden" name="uid" value="{{$medapp->id}}">
		
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label col-md-3">Paciente</label>
				<div class="col-md-9">
					<input readonly class="form-control" name="" id="patient_search" placeholder="buscar por nombre o apellido ..." value="{{$medapp->patient->name." ".$medapp->patient->lastname}}">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Tratamiento</label>
				<div class="col-md-9">
					<input readonly readonly type="text" class="form-control" name="treatment" id="" value="{{$medapp->treatment}}" >
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Doctores</label>
				<div class="col-md-9">
				@foreach($medapp->doctors as $doc)
					<p>
						@if(Auth::user()->can('ver_usuarios'))
						<a href="{{route('show_user_details',$doc->id)}}">{{$doc->name." ".$doc->lastname}}</a>
						@else
						{{$doc->name." ".$doc->lastname}}
						@endif
					</p>
				@endforeach
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Asistentes</label>
				<div class="col-md-9">
				@foreach($medapp->assistants as $assist)
					<p>
						@if(Auth::user()->can('ver_usuarios'))
						<a href="{{route('show_user_details',$assist->id)}}">{{$assist->name." ".$assist->lastname}}</a>
						@else
						{{$doc->name." ".$doc->lastname}}
						@endif
					</p>
				@endforeach
				</div>
			</div>

			<div class="form-group ">
	            <label class="control-label col-md-3">Confirmada</label>
	            <div class="col-md-9">
	              <div >
	                @if($medapp->confirmed)
	                    <span style="min-width: 2em;min-height: 2em" class="label label-success">Si</span>
	                @else
	                    <span style="min-width: 2em;min-height: 6em" class="label label-warning">No</span>
	                    <span>
                    		<button onclick="ajax_confirm_medapp()" type="button" class="btnm btn-xs btn-primary" >Confirmar hora médica</button>
	                	</span>
	                @endif
	              </div>
	            </div>
      		</div>


      		<div class="form-group ">
	            <label class="control-label col-md-3">Terminada</label>
	            <div class="col-md-9">
	              <div>
	                @if($medapp->ended)
	                    <span style="min-width: 2em" class="label label-success">Si</span>
	                @else
	                	<span style="min-width: 2em" class="label label-warning">Si</span>
						@if($medapp->confirmed)
						<span>
	                		<button type="button" onclick="ajax_end_medapp()" class="btnm btn-xs btn-primary">Finalizar hora médica</button>
	                	</span>
	                	@endif
	                @endif
	              </div>
	            </div>
      		</div>

			<div class="form-group">
				<label class="control-label col-md-3">Fecha y hora de inicio</label>
				<div class="col-md-9">
		            <div class="input-group date" id="new_fecha_hora_inicio" >
		                <span style="color: blue" class="input-group-addon">
	                  		<span class="glyphicon glyphicon-calendar"></span>
	                    </span>
		            <input readonly type='text' class="form-control" placeholder="" style="z-index: 0" name="start_time" value="{{$medapp->start_time}}">
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
		                <input readonly type='text' class="form-control" style="z-index: 0" placeholder="" name="end_time" value="{{$medapp->end_time}}">
		            </div>
		        </div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Descripción o comentario</label>
				<div class="col-md-9">
					<textarea class="form-control" name="description">{{$medapp->description}}</textarea>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-group">
		<button class="btn btn-info col-md-2 col-md-offset-4" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reiniciar formulario</button>
		<button class="btn btn-primary col-md-2" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar información</button>
	</div>
</form>

@endsection

<script type="text/javascript">
@section('scripts')

function ajax_confirm_medapp(){
  
    data={
      '_token':"{{csrf_token()}}",
      'medapp_id':{{$medapp->id}},
    };
    $.ajax({
      async:true,
      type:"POST",
      url:"{{route('medapp_confirm')}}",
      data:data,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
      success:function(msg){
        console.log(msg);
        alert("Hora médica confirmada");
      },
    });

}

@if($medapp->confirmed)
function ajax_end_medapp(){  
    data={
      '_token':"{{csrf_token()}}",
      'medapp_id':{{$medapp->id}},
    };
    $.ajax({
      async:true,
      type:"POST",
      url:"{{route('medapp_end')}}",
      data:data,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
      success:function(msg){
        console.log(msg);
        alert("Hora médica finalizada");
      },
    });

}
@endif

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

$('#medapp_confirm_button').click(function(){
	$('#medapp_confirm').submit()
})

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