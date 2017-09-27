@extends('layouts.base')
@section('title','Modificar perfil')
@section('panel_title','')
@section('content')

<form class="form" method="post" action="{{route('post_update_user')}}">
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
	<div class="row form-group">
		<label for="name" class="control-label col-md-1">Nombre</label>
		<div class="col-md-4">
			<input class="form-control" type="text" name="name" value="{{$user->name}}">
		</div>
		
		<label for="lastname" class="control-label col-md-1">Apellido</label>
		<div class="col-md-4">
			<input class="form-control" type="text" name="lastname" value="{{$user->lastname}}">
		</div>
	</div>

	<div class="row form-group">
		<label class="col-md-1" for="photo">Fotografía</label>
		<div class="col-md-3">
			<input id="photo_input" class="form-control" type="file" name="photo" value="{{$user->lastname}}">
		</div>
		<a href="javascript:void(0)" onclick="clear_photo_input()">[limpiar]</a>
	</div>
<div class="form-group col-md-12">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contraseña <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="password" class="form-control has-feedback-left" id="password" name="password">
		<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>

<div class="form-group col-md-12">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Reingresar contraseña <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="password" class="form-control has-feedback-left" id="password" name="password_confirmation">
		<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>
	<div class="form-group">
		
	</div>

	<button type="submit" class="btn btn-success">Guardar</button>
	<a class="btn btn-warning" href="{{route('show_user_details',[$user->id])}}">Cancelar y volver al perfil</a>
</form>
@endsection

<script type="text/javascript">
@section('scripts')
	function clear_photo_input(){
		$('#photo_input').wrap('<form>').closest('form').get(0).reset();
		$('#photo_input').unwrap();
	}

@endsection
</script>