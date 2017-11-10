@extends('layouts.base')
@section('title','Administración de pacientes')
@section('panel_title')
<h4>Registre, modifique, elimine y vea los pacientes registrados en el sistema</h4>
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

<div class="container">
	<div class="col col-md-12">
		<div class="col-md-4">
			<a class="btn btn-success" href="{{route('new_patient_form')}}">Registrar nuevo paciente</a>
		</div>
		
		<form method="GET" action="{{route('patients_search')}}">
		
		<div class="col-md-5">
			<input autofocus onFocus="this.select();" type="text" class="form-control" name="data" value="{{$data}}">
		</div>
		<div class="col-md-3 pull-right">
			<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
		</div>
		</form>
	</div>
	<div class="col-md-12">
		{{$patients->links()}}
	</div>
	<div class="fixed-responsive">
		@if(count($patients)==0)
		<div class="clearfix"></div>
		<center><p><h1>No se han encontrado coincidencias</h1></p></center>
		@else
		<table class="table">
			<thead>
				<th>RUT</th>
				<th>Apellido</th>
				<th>Nombre</th>
				<th>Género</th>
				<th>Edad</th>
				<th>Teléfono</th>
				<th>E-mail</th>
				<!--
				<th>Dirección</th>
				-->
			</thead>
			<tbody>
				@foreach($patients as $p)
				<tr class="tr_link" onclick="window.location='{{route('patient_detail',[$p->id])}}'">
					<td>{{$p->rut}}</td>
					<td>{{$p->lastname}}</td>
					<td>{{$p->name}}</td>
					<td>{{$p->gender}}</td>
					<td>{{$p->age()}}</td>
					<td>{{$p->phone}}</td>
					<td>{{$p->email}}</td>
					<!--
					<td>{{$p->address}}</td>
					-->
				</tr>
			
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>

@endsection