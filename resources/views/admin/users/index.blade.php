@extends('layouts.base')
@section('title','Adminsitración de usuarios')
@section('panel_title')
<h4>Registre, modifique, elimine y vea los usuarios registrados en el sistema</h4>
@endsection
@section('content')

<div>
	<a class="btn btn-success" href="{{route('new_user_form')}}"><i class="fa fa-plus" aria-hidden="true"></i> Registrar nuevo usuario</a>
</div>

<div class="panel panel-default">
<div class="panel-heading">
	Buscar usuarios
</div>
<div class="panel-body">
	<div class="col-sm-6">
		<label class="col-sm-12">Introduzca texto por el cual buscar</label>
		<div class="col-sm-12">
		<input class="form-control" type="text" placeholder="Ej: Juan Pérez">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="col-sm-6 pull-left">
			<label class="col-sm-12">Parámetro de búsqueda</label>
			<div class="col-sm-12">
			<select class="form-control">
				<option>Nombre</option>
				<option>Apellido</option>
				<option>RUT</option>
				<option>E-mail</option>
			</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-sm-12">
				&nbsp;
			</div>
			<div class="col-sm-12">
				<button class="btn btn-primary">Buscar!</button>
				<button class="btn btn-sm btn-link">[Quitar filtro]</button>
			</div>
		</div>
	</div>
</div>
</div>
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
				<td>{{$user->name}}
					@if(Auth::user()->id==$user->id)
					<strong style="color: green">(es usted)</strong>
					@endif
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
@endsection