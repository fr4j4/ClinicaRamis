@extends('layouts.base')
@if($medApps)
@section('title')
Agenda general
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
@if($medApps)
<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Asignar hora médica</a>
<div class="container">
	<div id="calendar"></div>

</div>

@else
<h1 style="color: red">Agenda no disponible</h1>
@endif
@endsection

<script type="text/javascript">
@section('scripts')
var doctors=[];


function get_doctors_list(){
	$.ajax({
      async:true,
      type:"GET",
      url:"{{route('api_get_doctors_list')}}",
      data:{},
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
      success:function(msg){
        /*
        console.log('done!');
        */
        doctors=msg;
      },
    });
}

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