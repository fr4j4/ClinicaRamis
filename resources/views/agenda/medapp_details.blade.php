@extends('layouts.base')
@section('title','Detalles hora médica')

@section('panel_title')
<div class="col-md-12">
	<a href="{{route('show_general_agenda')}}" class="col-md-3 btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Ir a agenda general clínica</a>
	<a href="{{route('medapp_update',$medapp->id)}}" class="col-md-2 btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Actualizar estado</a>
	<!--
	<a href="#" class="col-md-2 btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>  Cancelar</a>
	-->
</div>

@endsection

@section('content')
<div class="container">
	
<div class="col col-md-6">
	<table class="table">
		<tbody>
			<tr>
				<th class="col-md-4">Paciente</th>
				<td>

					@if(Auth::user()->can('ver_usuarios'))
						<a href="{{route('show_patient_details',$medapp->patient->id)}}">{{$medapp->patient->name." ".$medapp->patient->lastname}}</a>
					@else
						{{$medapp->patient->name." ".$medapp->patient->lastname}}
					@endif
				</td>
			</tr>
			<tr>
				<th>Tratamiento</th>
				<td>{{$medapp->treatment}}</td>
			</tr>
			<tr>
				<th class="col-md-4">Doctores</th>
				<td>
					
					@foreach($medapp->doctors as $doctor)
						<p>	
						@if(Auth::user()->can('ver_usuarios'))
							<a href="{{route('show_user_details',$doctor->id)}}">{{$doctor->name." ".$doctor->lastname}}</a>
						@else
							{{$doctor->name." ".$doctor->lastname}}
						@endif
						</p>
					@endforeach
					
				</td>
			</tr>
			<tr>
				<th class="col-md-4">Asistentes</th>
				<td>
					
					@foreach($medapp->assistants as $assist)
						<p>
						@if(Auth::user()->can('ver_usuarios'))
							<a href="{{route('show_user_details',$assist->id)}}">{{$assist->name." ".$assist->lastname}}</a>
						@else
							{{$doctor->assist." ".$doctor->assist}}
						@endif
						</p>
					@endforeach
					</ul>
				</td>
			</tr>
			<tr>
				<th>Descripción/comentario</th>
				<td>{{$medapp->description}}</td>
			</tr>
			<tr>
				<th>Fecha y hora inicio</th>
				<td>{{$medapp->start_time}}</td>
			</tr>
			<tr>
				<th>Hora y hora fin</th>
				<td>{{$medapp->end_time}}</td>
			</tr>
			<tr>
				<th>Hora confirmada?</th>
				<td>{{$medapp->confirmed?'Si':'No'}}</td>
			</tr>
			<tr>
				<th>Hora terminada?</th>
				<td>{{$medapp->ended?'Si':'No'}}</td>
			</tr>
		</tbody>
	</table>
</div>

</div>
@endsection

@section('modals')
@endsection