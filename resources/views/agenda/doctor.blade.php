@extends('layouts.base')
@if($doctor)
@section('title')
Agenda de {{$doctor->name." ".$doctor->lastname}}
@endsection
@endif

@section('styles')
<style type="text/css">
	.fc-today{
		background-color: rgba(186,225,255,.5) !important;
		color:black;
	}
</style>
@endsection

@section('content')
@if($doctor)

<div class="container">
	<div id="calendar"></div>

</div>

@else
<h1 style="color: red">Usuario solicitado no es doctor</h1>
@endif
@endsection

<script type="text/javascript">
@section('scripts')

@endsection

@section('ready_scripts')

$('#calendar').fullCalendar({
    locale:'es',
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay,list'
	},
	buttonText:{
	    today:    'hoy',
	    month:    'mes',
	    week:     'semana',
	    day:      'día',
	    list:     'lista'
	},
});
@if($medApps)
	@foreach($medApps as $m)
		 $('#calendar').fullCalendar('renderEvent',{
		 	title:'{{$m->patient->name." ".$m->patient->lastname}}',
		 	start:moment.utc('{{$m->start_time}}', 'YYYY-MM-DD HH:mm:ss').toISOString(),
		 	end:moment.utc('{{$m->end_time}}', 'YYYY-MM-DD HH:mm:ss').toISOString(),
		 });
	@endforeach
@endif
//$('#calendar').fullCalendar( 'next')
@endsection
</script>