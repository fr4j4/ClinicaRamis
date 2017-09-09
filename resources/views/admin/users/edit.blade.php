@extends('layouts.base')
@section('title','Modificar perfil')
@section('panel_title','')
@section('content')

<form class="form">
	{{csrf_field()}}
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