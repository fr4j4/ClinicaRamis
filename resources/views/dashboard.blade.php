@extends('layouts.base')
@section('title','Dashboard')
@section('panel_title','Bienvenido, esto es el dashboard.')
@section('content')
En esta pantalla se mostrará información correspondiente al rol que tenga el usuario autenticado
Desde usuarios registrados hasta horas médicas.


@foreach($stats as $stat)
	<div class="col-md-3">
		<div class="tile-stats">
		  <div class="icon"><i class="fa fa-users"></i>
		  </div>
		  <div class="count">{{$stat->value}}</div>
		  <h3 style="text-transform: capitalize;">{{$stat->title}}</h3>
		  <p>Lorem ipsum psdea itgum rixt.</p>
		</div>
	</div>
@endforeach

<!--

<div class="col-md-3">
	<div class="tile-stats">
	  <div class="icon"><i class="fa fa-caret-square-o-right"></i>
	  </div>
	  <div class="count">179</div>

	  <h3>New Sign ups</h3>
	  <p>Lorem ipsum psdea itgum rixt.</p>
	</div>
</div>
-->

@endsection

@section('scripts')

@endsection