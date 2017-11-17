@extends('layouts.base')
@section('title','Editar información de paciente')
@section('panel_title')
<h5><a class="btn btn-sm btn-warning" href="{{route('show_patient_details',$patient->id)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
 Cancelar y Volver a Detalles del Paciente</a></h5>
@endsection
@section('content')

<div>
	<form onreset="" enctype="multipart/form-data" class="form" method="post" action="{{route('post_update_patient')}}">
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
		{{csrf_field()}}
		<input type="hidden" name="uid" value="{{$patient->id}}">


		<label class="control-label">Datos personales</label>
		<div class="clearfix"></div>

		<div class="col-md-2" style="border:black solid 2px;border-radius:10px;">
			<center>
			<img id="patient_img" name="patient_img" alt="avatar" width="100" height="100" src="{{ asset('/patient_pictures/'.$patient->picture) }}" >
			<input style="display: none" type="file" id="input_image" name="image" accept="image/*" onchange="document.getElementById('patient_img').src = window.URL.createObjectURL(this.files[0])">
			<label for="input_image" class="btn btn-xs btn-primary">Seleccionar Imagen...</label>
			</center>
		</div>
		<div class="col-md-10">
			
		<label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Nombre *</label>
		<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control has-feedback-left" id="input_name" placeholder="Nombre" value="{{$patient->name}}" name="name">
			<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">Apellido*</label>
		<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control" id="input_apellido" placeholder="Apellido" value="{{$patient->lastname}}" name="lastname">
			<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
		</div>


<div class="col-md-12 ">
      <div class="form-group row">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Género</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            @if($patient->gender=="mujer")
		                        <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                          <input type="radio" name="gender" value="mujer" checked> &nbsp; Mujer &nbsp;
		                        </label>
		                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                          <input type="radio" name="gender" value="hombre"> Hombre
		                        </label>
	                            <label class="btn btn-default " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            	  <input type="radio" name="gender"value ="none"> No especificado
                            	</label>
		                    @else
		                    	@if($patient->gender=="hombre")
		                    		<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                              <input type="radio" name="gender" value="mujer" > &nbsp; Mujer &nbsp;
		                            </label>
		                            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                              <input type="radio" name="gender" value="hombre" checked> Hombre
		                            </label>
		                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                	  <input type="radio" name="gender"value ="none"> No especificado
                                	</label>
		                    	@else
									<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                              <input type="radio" name="gender" value="mujer"> &nbsp; Mujer &nbsp;
		                            </label>
		                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                              <input type="radio" name="gender" value="hombre"> Hombre
		                            </label>
		                            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                	  <input type="radio" name="gender" checkedvalue ="none"> No especificado
                                	</label>
		                    	@endif
                            @endif
                          </div>
                        </div>
      </div>
</div>

        <label class="control-label col-md-2 col-md-push-0" style="text-align: right;">Fecha nacimiento</label>
        <div class="col-md-4 ">
            <div class="input-group date" id="fecha_nac" >
                <span style="color: blue" class="input-group-addon">
                   <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type='text' class="form-control" placeholder="Fecha nacimiento" name="birthday"  value="{{Carbon\Carbon::parse($patient->birthday)->format('d/m/Y')}}">
            </div>
        </div>



		<label class="control-label col-md-1 col-sm-1 col-xs-12">R.U.T*</label>
		<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control has-feedback-right" value="{{$patient->rut}}" name="rut" placeholder="ej: 00111222-3">
			<span class="fa fa-address-card-o form-control-feedback right " aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1" >E-mail</label>
		<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control has-feedback-left" id="input_email" placeholder="Email" value="{{$patient->email}}" name="email">
			<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">Teléfono</label>
		<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
			<input class="form-control has-feedback-right" type="text" id="input_telefono" placeholder="Teléfono" value="{{$patient->phone}}" name="phone">
			<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Dirección</label>
		<div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control has-feedback-left" id="input_direccion" placeholder="Dirección" value="{{$patient->address}}" name="address">
			<span class="fa fa-address-card form-control-feedback left" aria-hidden="true"></span>
		</div>

		</div>

		</fieldset>
		<div class="form-group">
			<button class="btn btn-info col-md-2 col-md-offset-4" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reiniciar formulario</button>
			<button class="btn btn-primary col-md-2" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar información</button>
		</div>
	</form>
</div>

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