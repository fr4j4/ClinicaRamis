@extends('layouts.base')
@section('title','Administración de usuarios')
@section('panel_title')
<h4>Registre, modifique, elimine y vea los usuarios registrados en el sistema</h4>
@endsection
@section('content')
<style type="text/css">
	.tr_link:hover{
		color: white;
		background: #3B5998;
	}
	.tr_link{
		cursor: pointer;
	}
</style>

<div class="row">
@can('crear_usuarios')
	<div class="col-md-4">
		<a class="btn btn-success" href="{{route('new_user_form')}}"><i class="fa fa-plus" aria-hidden="true"></i> Registrar Nuevo Usuario</a>
	</div>
@endcan
	<form method="GET" action="{{route('users_search')}}">
	<div class="col-md-5">
		<input type="text" class="form-control" name="data" autofocus>
	</div>
	<div class="col-md-3 pull-right">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
	</div>
	</form>
</div>

<div class="fixed-responsive">
<table class="table">
	<thead>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Alias</th>
		<th>E-mail</th>
		<th>Roles</th>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr  class="tr_link" onclick="window.location='{{route('show_user_details',[$user->id])}}'">
				<td>
					{{$user->name}}
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
			</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection