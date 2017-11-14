@extends('layouts.base')
@section('title','Modificar perfil')
@section('panel_title')
<h5><a class="btn btn-primary" href="{{route('show_user_details',$user->id)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
 Volver a detalles</a></h5>
@endsection
@section('content')
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
		<input type="hidden" name="uid" value="{{$user->id}}">

		<!--
<input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
		-->


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
			<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
				<button class="btn btn-primary" type="reset">Reset</button>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>

	</form>
</div>

@endsection