@extends('layouts.base')
@section('title','Registrar nuevo usuario')
@section('panel_title')
<h5><a class="btn btn-sm btn-warning" href="{{route('admin_users_index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver a lista de usuarios</a></h5>

<div class="form-group pull-right">
<div class="row">
	<button id="reset_btn" class="btn btn-primary" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reiniciar Formulario</button>
	<button id="submit_btn" type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar información de usuario</button>	
</div>
</div>
@endsection
@section('content')

<div class="x_panel">
	<div class="x_content">
		<br/>
	    @if ($errors->any())
	    <div class="alert alert-danger">
	      <ul>
	        @foreach ($errors->all() as $error)
	        <li>{{ $error }}</li>
	        @endforeach
	      </ul>
	    </div>
	    @endif
		<form id="new_form" onreset="" enctype="multipart/form-data" class="form" method="post" >
			<fieldset>
				{{csrf_field()}}
				<label class="control-label">Datos personales</label>
				<div class="clearfix"></div>
				
					<div class="col-md-2" style="border:black solid 2px;border-radius:10px;padding: 1px;">
			    		<center>


						<img style="padding: 0px" id="usr_avatar" name="usr_avatar" alt="avatar" width="100" height="100" src="{{asset('user_avatars/default.png')}}" >
						<input style="display: none" type="file" id="input_image" name="avatar" accept="image/*" onchange="document.getElementById('usr_avatar').src = window.URL.createObjectURL(this.files[0])">
						<label for="input_image" class="btn btn-xs btn-primary">Seleccionar Imagen...</label>
						</center>
					</div>
					<div class="col-md-10">
						    
						    <label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Nombre *</label>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							  <input type="text" class="form-control has-feedback-left" id="input_name" placeholder="Nombre"  name="firstname" value="{{old("input_name")}}">
							  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>

							<label class="control-label col-md-2 col-sm-2 col-xs-12">Apellido*</label>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback col-md-pull-1">
							  <input type="text" class="form-control" id="input_apellido" placeholder="Apellido"  name="lastname" value="{{old("input_apellido")}}">
							  <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
							</div>

							<label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">R.U.T*</label>
						    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						      <input type="text" class="form-control has-feedback-left"  name="rut" value="{{old("rut")}}" placeholder="ej: 00111222-3">
						      <span class="fa fa-address-card-o form-control-feedback left " aria-hidden="true"></span>
						    </div>
    
						    <label class="control-label col-md-2 col-sm-2 col-xs-12 " >E-mail</label>
						    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback col-md-pull-1">
						      <input type="text" class="form-control has-feedback-right" id="input_email" placeholder="Email"  name="email" value="{{old("input_email")}}">
						      <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
						    </div>
						    
						    <label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Teléfono</label>
						    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						      <input class="form-control has-feedback-left" type="text" id="input_telefono" placeholder="Teléfono"  name="phone" value="{{old("input_telefono")}}">
						      <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
						    </div>
						    
					</div>
					<div class="col-md-12">
						<div class="ln_solid"></div>
						<label class="control-label">Acceso</label>
						<div class="clearfix"></div>
						<div class="col-md-10 col-md-push-2">
								<div class="form-group row">
									<label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Alias</label>
									<div class="col-md-4 col-sm-4 col-xs-12 has-feedback">
										<input type="text" class="form-control has-feedback-left" placeholder="Alias" name="nickname">
										<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>


								<div class="form-group row">
									<label class="control-label col-md-2 col-sm-2 col-xs-12">Nueva contraseña</label>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<input type="password" class="form-control has-feedback-left" placeholder="Nueva contraseña" name="password">
										<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>

								<div class="form-group row">
									<label class="control-label col-md-2 col-sm-2 col-xs-12">Confirmar nueva contraseña</label>
									<div class="col-md-4 col-sm-4 col-xs-12 has-feedback">
										<input type="password" class="form-control has-feedback-left" placeholder="Repetir nueva contraseña" name="password_confirmation">
										<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>
						</div>
					</div>
			</fieldset>
			<div class="ln_solid"></div>

		</form>
	</div>
</div>
@endsection
<script type="text/javascript">
@section('ready_scripts')
	$('#submit_btn').click(function(){$('#new_form').submit()})
	$('#reset_btn').click(function(){$('#new_form')[0].reset()})
@endsection
</script>