@extends('layouts.base')
@section('title','Detalles hora médica')

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
				<th>Fecha y hora inicio</th>
				<td>{{$medapp->start_time}}</td>
			</tr>
			<tr>
				<th>Hora y hora fin</th>
				<td>{{$medapp->end_time}}</td>
			</tr>
		</tbody>
	</table>
</div>

</div>
@endsection

@section('modals')
@endsection