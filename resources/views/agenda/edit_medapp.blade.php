@extends('layouts.base')
@section('title','Modificar hora médica')
@section('panel_title')
<a class="col-md-4 btn btn-sm btn-primary" href="{{route('medapp_details',$medapp->id)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
 Cancelar y Volver a Detalles de hora médica</a>
<a class="col-md-2 btn btn-sm btn-success" href="{{route('medapp_details',$medapp->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i>
 Confirmar hora médica</a>
<a class="col-md-2 btn btn-sm btn-warning" href="{{route('medapp_details',$medapp->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i>
 Terminar hora médica</a>
@endsection
@section('content')

<form class="form-horizontal form-label-left" id="new_appointment_form" method="POST" action="{{route('post_new_medical_appointment')}}">
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

@endsection

<script type="text/javascript">
@section('scripts')

@endsection

@section('ready_scripts')
    $('#fecha_nac').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es'
    });
@endsection
</script>