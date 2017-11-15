@extends('layouts.base')
@section('title','Inicio')
@section('panel_title')
Bienvenido, {{Auth::user()->name}}.
@endsection
@section('content')
<p>
<h3>Resumen del sistema</h3>
</p>

<div class="container well">

@foreach($stats as $stat)
	<div class="col-md-3">
		<div class="tile-stats">
		  <div class="icon"><i class="fa fa-users"></i>
		  </div>
		  <div class="count">{{$stat->value}}</div>
		  <h3 style="text-transform: capitalize;">{{$stat->title}}</h3>
		  <p><a href="{{route('admin_users_index')}}" class="btn btn-xs btn-info">ver usuarios registrados</a></p>
		</div>
	</div>
@endforeach
</div>

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