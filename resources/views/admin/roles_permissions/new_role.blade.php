@extends('layouts.base')
@section('title','Crear un nuevo rol')
@section('panel_title')
<h4>Complete los campos mostrados a continuación.</h4>
@endsection
@section('content')

<div class="well well-md-12">
		<form id="form" class="form-horizontal" method="post" onsubmit="presubmit()">
		@if($errors)
		   @foreach ($errors->all() as $error)
		      <p class="label-danger" style="color: white">{{ $error }}</p>
		  @endforeach
		@endif 
		{{csrf_field()}}
			<div class="form-group">
				<label class="col-md-3" for="display_name">Nombre para mostrar en pantalla (debe ser único)</label>
				<div class="col-md-3">
					<input class="form-control text-lowercase" type="text" name="display_name" placeholder="Ej: Administrador">
				</div>

				<label class="col-md-3" for="name">Nombre clave (debe ser único)</label>
				<div class="col-md-3">
					<input class="form-control text-lowercase" type="text" name="name" placeholder="Ej: admin">
				</div>
				<div class="clearfix"></div>
				<br>
      			
				<div class="form-group">
					<div class="col-md-12">
						<div class="panel panel-primary">	
							<div class="panel-heading">	
								<h2 class="panel-title">Asignar permisos</h2>
							</div>
							<div class="panel-body">	
							<p>Seleccione los permisos que desée asignar al nuevo rol</p>
	<ul class="nav-pills" style="list-style-type: none;">
				@foreach($permissions as $permission)
		<li>		<a  onclick="toggle_select({{$permission->id}})" href="#"><h4><span id="{{"perm_".$permission->id}}" class="label label-default" p_name="{{$permission->name}}">{{$permission->display_name}}</span></h4></a>
		</li>
				@endforeach
	</ul>
							</div>
						</div>
					</div>
				</div>
<!--
	<input type="text" name="perms_id[]" value="1">
	<input type="text" name="perm_id[]" value="2">
	<input type="text" name="perm_id[]" value="3">
-->
				<a href="{{route('roles_permissions_index')}}" class="btn btn-warning">Cancelar y volver</a>
				<button class="btn btn-success">Crear rol</button>
			</div>
		</form>

</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		function presubmit(){
			$('.label-success').each(function(){
				$('#form').append('<input type="text" name="perm_names[]" value="'+$(this).attr('p_name')+'">');
			});
		}

	function toggle_select(id){
		if($('#perm_'+id).hasClass('label-default')){
			$('#perm_'+id).removeClass('label-default')
			$('#perm_'+id).addClass('label-success')
		}
		else if($('#perm_'+id).hasClass('label-success')){
			$('#perm_'+id).removeClass('label-success')
			$('#perm_'+id).addClass('label-default')
		}
	}
	</script>
@endsection