@extends('layouts.base')
@section('title','Administración de usuarios')
@section('panel_title')
<h4>Registre, modifique, elimine y vea los usuarios registrados en el sistema</h4>
@endsection
@section('content')

<div class="row">
@can('crear_usuarios')
	<div class="col-md-4">
		<a class="btn btn-success" href="{{route('new_user_form')}}"><i class="fa fa-plus" aria-hidden="true"></i> Registrar Nuevo Usuario</a>
	</div>
@endcan
	<form method="GET">
	<div class="col-md-5">
		<input type="text" class="form-control" name="data" value="{{$data}}" autofocus onFocus="this.select();">
	</div>
	<div class="col-md-3 pull-right">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
	</div>
	</form>
</div>

@if(count($users)==0)
<div class="clearfix"></div>
<center><p><h1>No se han encontrado coincidencias</h1></p></center>
@else
<div class="table-responsive">
<table class="table table-striped">
	<thead>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>alias</th>
		<th>E-mail</th>
		<th>Roles</th>
		<th>Acción</th>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr>
				<td>
					<a href="{{route('show_user_details',[$user->id])}}">{{$user->name}}
					@if(Auth::user()->id==$user->id)
					<strong style="color: green">(es usted)</strong>
					@endif
					</a>
				</td>
				<td>{{$user->lastname}}</td>
				<td>{{$user->nickname}}</td>
				<td>{{$user->email}}</td>
				<td>
				@foreach($user->roles as $role)
					{{$role->name}}
				@endforeach
				</td>
				<td><a href="{{route('show_user_details',[$user->id])}}">ver perfil</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>
@endif
@endsection