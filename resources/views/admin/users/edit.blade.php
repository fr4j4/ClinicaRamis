@extends('layouts.base')
@section('title','Modificar perfil')
@section('panel_title')
<h5><a class="btn btn-sm btn-warning" href="{{route('show_user_details',$user->id)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y volver a detalles</a></h5>
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
		<form id="edit_form" onreset="" enctype="multipart/form-data" class="form" method="post" action="{{route('post_update_user')}}" >
			{{csrf_field()}}
			<fieldset>
				<input type="hidden" name="uid" value="{{$user->id}}">
				{{csrf_field()}}
				<label class="control-label">Datos personales</label>
				<div class="clearfix"></div>
				
					<div class="col-md-2" style="border:black solid 2px;border-radius:10px;padding: 1px;">
			    		<center>


						<img style="padding: 0px" id="usr_avatar" name="usr_avatar" alt="avatar" width="100" height="100" src="{{ asset('/user_avatars/'.$user->avatar) }}" >
						<input style="display: none" type="file" id="input_image" name="avatar" accept="image/*" onchange="document.getElementById('usr_avatar').src = window.URL.createObjectURL(this.files[0])">
						<label for="input_image" class="btn btn-xs btn-primary">Seleccionar Imagen...</label>
						</center>
					</div>
					<div class="col-md-10">
						    
						    <label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Nombre *</label>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							  <input type="text" class="form-control has-feedback-left" id="input_name" placeholder="Nombre"  name="name" value="{{$user->name}}">
							  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>

							<label class="control-label col-md-2 col-sm-2 col-xs-12">Apellido*</label>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback col-md-pull-1">
							  <input type="text" class="form-control" id="input_apellido" placeholder="Apellido"  name="lastname" value="{{$user->lastname}}">
							  <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
							</div>

							<label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">R.U.T*</label>
						    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						      <input type="text" class="form-control has-feedback-left"  name="rut" value="{{$user->rut}}" placeholder="ej: 00111222-3">
						      <span class="fa fa-address-card-o form-control-feedback left " aria-hidden="true"></span>
						    </div>
    
						    <label class="control-label col-md-2 col-sm-2 col-xs-12 " >E-mail</label>
						    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback col-md-pull-1">
						      <input type="text" class="form-control has-feedback-right" id="input_email" placeholder="Email"  name="email" value="{{$user->email}}">
						      <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
						    </div>
						    
						    <label class="control-label col-md-2 col-sm-2 col-xs-12 col-md-push-1">Teléfono</label>
						    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						      <input class="form-control has-feedback-left" type="text" id="input_telefono" placeholder="Teléfono"  name="phone" value="{{$user->phone}}">
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
										<input type="text" class="form-control has-feedback-left" placeholder="Alias" name="nickname" value="{{$user->nickname}}">
										<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>


								<div class="form-group row">
									<p class="label label-warning">Dejar en blanco para mantener!</p>
									<label class="control-label col-md-2 col-sm-2 col-xs-12">Nueva contraseña</label>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<input type="password" class="form-control has-feedback-left" placeholder="" name="password">
										<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>

								<div class="form-group row">
									<p class="label label-warning">Dejar en blanco para mantener!</p>
									<label class="control-label col-md-2 col-sm-2 col-xs-12">Confirmar nueva contraseña</label>
									<div class="col-md-4 col-sm-4 col-xs-12 has-feedback">
										<input type="password" class="form-control has-feedback-left" placeholder="" name="password_confirmation">
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



<!--
<div class="x_content">
	<br />
	<form enctype="multipart/form-data" class="form-horizontal form-label-left" method="post" action="{{route('post_update_user')}}">
		{{csrf_field()}}
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
		


<input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
		


		<label class="control-label">Datos personales</label>
		<div class="ln_solid"></div>

		<div class="form-group">
			<p>Avatar</p>
			<img id="usr_avatar" alt="avatar" width="100" height="100" src="{{ asset('/user_avatars/'.$user->avatar) }}" >
			<input type="file" name="avatar" accept="image/*" onchange="document.getElementById('usr_avatar').src = window.URL.createObjectURL(this.files[0])">
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">Nombre</label>
		<div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nombre" value="{{$user->name}}" name="name">
			<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">Apellido</label>
		<div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control" id="inputSuccess3" placeholder="Apellido" value="{{$user->lastname}}" name="lastname">
			<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">R.U.T</label>
		<div class="col-md-5 col-sm-5 col-xs-5">
			<input type="text" class="form-control has-feedback-left" value="{{$user->rut}}" name="rut">
			<span class="fa fa-address-card-o form-control-feedback left" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">E-mail</label>
		<div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
			<input type="text" class="form-control has-feedback-right" id="inputSuccess4" placeholder="Email" value="{{$user->email}}" name="email">
			<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
		</div>

		<label class="control-label col-md-1 col-sm-1 col-xs-12">Teléfono</label>
		<div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
			<input class="form-control has-feedback-left" type="text" id="inputSuccess5" placeholder="Teléfono" value="{{$user->phone}}" name="phone">
			<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
		</div>


		<div class="clearfix"></div>
		<div class="ln_solid"></div>
		<label class="control-label">Acceso</label>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Alias</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control has-feedback-right" placeholder="Alias" value="{{$user->nickname}}" name="alias">
				<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
			</div>
		</div>

		<label class="control-label" style="color: orange">Cambio de contraseña, dejar en blanco para mantener</label>

		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="password" class="form-control" placeholder="Nueva contraseña" name="password">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar nueva contraseña</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="password" class="form-control" placeholder="Repetir nueva contraseña" name="password_confirmation">
			</div>
		</div>

		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="row">
				<button class="btn btn-primary col-md-2 col-md-offset-4" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reiniciar Formulario</button>
				<button type="submit" class="btn btn-success col-md-2"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar Información</button>
			</div>
		</div>

	</form>
</div>
-->

@endsection
<script type="text/javascript">
@section('ready_scripts')
	$('#submit_btn').click(function(){$('#edit_form').submit()})

	$('#reset_btn').click(function(){$('#edit_form')[0].reset()})
@endsection
</script>